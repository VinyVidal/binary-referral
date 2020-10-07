<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function showLogin(Request $request)
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Usuário ou senha incorretos'
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Caso exista o valor ref na url página de cadastro
        if($request->has('ref')) {
            // Coloca o valor de ref (username do dono do link de indicação)
            session(['referrer' => $request->query('ref')]);
        }

        return view('register');
    }

    /**
     * Cadastrar novo usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['username'] = explode('@', $data['email'])[0];
            // TODO: Caso o username exista, adicionar um número na frente

            $referrer = User::where('username', session('referrer'))->first();
            
            
            if(isset($referrer)) {
                // Se o usuário estiver se cadastrando por um link de indicação
                $data['referrer_id'] = $referrer->id;
                if($referrer->referrals->count() >= 2) {
                    // Retonar erro caso 2 usuários já tiverem usado o mesmo link de indicação
                    return redirect()->back()->with([
                        'success' => false,
                        'message' => 'Erro, este link de indicação pertence à um usuário que já atingiu o numero limite de indicações.'
                        ]);
                } else if($referrer->referrals->count() >= 1) {
                    // Se este link já foi usado por 1 usuário, alocar o novo usuário à direita da "arvore"
                    $data['level'] = 2;
                    
                    $user = new User;
                    $user->fill($data);
                    $user->save();

                    // Atribuir 100 pontos do lado direto da árvore ao usuário que indicou o novo usuário cadastrado
                    $referrer->right_points += 100;
                    $referrer->save();
                } else {
                    // Se este link ainda não foi usado, alocar o novo usuário à esquerda da "árvore"
                    $data['level'] = 1;

                    $user = new User;
                    $user->fill($data);
                    $user->save();
                    
                    // Atribuir 100 pontos do lado esquerdo da árvore ao usuário que indicou o novo usuário cadastrado
                    $referrer->left_points += 100;
                    $referrer->save();
                }
                
            } else {
                // Cadastro normal
                $data['level'] = 0;

                $user = new User;
                $user->fill($data);
                $user->save();
            }

            Auth::login($user);
            return redirect()->route('dashboard', [
                'success' => true,
                'message' => 'Seu cadastro foi realizado com sucesso!'
            ]);
        
        } catch (Exception $ex) {
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Algo deu errado'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
