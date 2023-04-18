<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Inertia\Inertia;
use App\Models\DirectMessage;
use App\Events\DirectMessageCreated;

class DirectMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        // ログイン者以外のユーザーを取得
        $users = User::where('id','<>',$user->id)
                ->select('id','name')
                ->get();
        
        return Inertia::render('DirectMessage/Index',[
            'users' => $users
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $directMessage = new DirectMessage();
        $directMessage->message = $request->message;
        $directMessage->send = $user->id;
        $directMessage->recieve = $request->recieve;

        $directMessage->save();
        event(new DirectMessageCreated($directMessage));

        return $directMessage;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $opponent = User::findOrFail($id);
        $loginUser = Auth::user();

        $loginUserId = Auth::id();
        $allUsers = User::where('id','<>',$loginUserId)
            ->select('id','name')
            ->get();

        return Inertia::render('DirectMessage/Show',[
            'opponent' => $opponent,
            'loginUser' => $loginUser,
            'allUsers' => $allUsers,
        ]);
    }

    public function getDirectMessage(Request $request){
        // dd($request);
        $send = $request->send;
        $recieve = $request->recieve;

        $directMessages = DirectMessage::where([['send',$send],['recieve',$recieve]])
                        ->orWhere([['send',$recieve],['recieve',$send]])
                        ->get();
                        
        return $directMessages;
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
