<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Auth;

class MessageController extends Controller
{
    /**
     * Display the constructor of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:create_messages',['only'=>'create']);
        $this->middleware('permission:edit_messages',['only'=>['edit','store']]);
        $this->middleware('permission:can_send_public_message',['only'=>'storeAll']);
        $this->middleware('permission:delete_messages',['only'=>'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=null)
    {
        $message_data = new Request();
        $message_data->allCount   = Message::where('sender_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->count();
        $message_data->inboxCount = Message::where([['status', 'inbox'],['receiver_id', Auth::user()->id]])->count();
        $message_data->trashCount = Message::where([['status', 'trash'],['receiver_id', Auth::user()->id]])->count();
        $message_data->draftCount = Message::where([['status', 'draft'],['sender_id', Auth::user()->id]])->count();
        $message_data->starredCount  = Message::where([['status', 'starred'],['receiver_id', Auth::user()->id]])->count();
        $message_data->sentCount  = Message::where('sender_id', Auth::user()->id)->whereNull('visibility')->count();

        $message_data->impCount   = Message::where([
            ['folder', 'important'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'important'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->urgCount   = Message::where([
            ['folder', 'urgent'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'urgent'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->offCount   = Message::where([
            ['folder', 'official'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'official'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->unoffCount = Message::where([
            ['folder', 'unofficial'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'unofficial'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->normalCount= Message::where([
            ['folder', 'normal'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'normal'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->users      = User::latest()->get();
        if ($type == 'inbox') {
            $message_data->messages   = Message::where([['status', $type],['receiver_id', Auth::user()->id]])->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }
        elseif ($type == 'trash') {
            $message_data->messages   = Message::where([['status', $type],['receiver_id', Auth::user()->id]])->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }
        elseif ($type == 'draft') {
            $message_data->messages   = Message::where([['status', $type],['sender_id', '=', Auth::user()->id]])->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }
        elseif ($type == 'sent') {
            $message_data->messages   = Message::where('sender_id', Auth::user()->id)->whereNull('visibility')->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }
        elseif ($type == 'starred') {
            $message_data->messages   = Message::where([['status', $type],['receiver_id', Auth::user()->id]])->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }
        // priority mailing
        elseif ($type == 'important') {
            $message_data->messages   = Message::where([['folder', $type],['receiver_id', Auth::user()->id]])->orWhere([['folder', $type],['sender_id', Auth::user()->id]])->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }
        elseif ($type == 'urgent') {
            $message_data->messages   = Message::where([['folder', $type],['receiver_id', Auth::user()->id]])->orWhere([['folder', $type],['sender_id', Auth::user()->id]])->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }
        elseif ($type == 'official') {
            $message_data->messages   = Message::where([['folder', $type],['receiver_id', Auth::user()->id]])->orWhere([['folder', $type],['sender_id', Auth::user()->id]])->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }
        elseif ($type == 'unofficial') {
            $message_data->messages   = Message::where([['folder', $type],['receiver_id', Auth::user()->id]])->orWhere([['folder', $type],['sender_id', Auth::user()->id]])->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }
        elseif ($type == 'normal') {
            $message_data->messages   = Message::where([['folder', $type],['receiver_id', Auth::user()->id]])->orWhere([['folder', $type],['sender_id', Auth::user()->id]])->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }else{
            $type = 'all';
            $message_data->messages   = Message::where('sender_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->latest()->paginate(10);
            return view('user.messages.index', compact(['message_data','type']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type=null)
    {
        $message_data = new Request();
        $message_data->allCount   = Message::where('sender_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->count();
        $message_data->inboxCount = Message::where([['status', 'inbox'],['receiver_id', Auth::user()->id]])->count();
        $message_data->trashCount = Message::where([['status', 'trash'],['receiver_id', Auth::user()->id]])->count();
        $message_data->draftCount = Message::where([['status', 'draft'],['sender_id', Auth::user()->id]])->count();
        $message_data->starredCount  = Message::where([['status', 'starred'],['receiver_id', Auth::user()->id]])->count();
        $message_data->sentCount  = Message::where('sender_id', Auth::user()->id)->whereNull('visibility')->count();
        $message_data->impCount   = Message::where([
            ['folder', 'important'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'important'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->urgCount   = Message::where([
            ['folder', 'urgent'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'urgent'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->offCount   = Message::where([
            ['folder', 'official'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'official'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->unoffCount = Message::where([
            ['folder', 'unofficial'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'unofficial'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->normalCount= Message::where([
            ['folder', 'normal'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'normal'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->users      = User::latest()->get();
        $message_data->cons_types = ConsultationType::latest()->get();

        $type = $type ?? 'all';

        return view('user.messages.create', compact(['message_data','type']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type=null)
    {
        request()->validate([
            'sender_id'    => 'required',
            'receiver_id'  => 'required',
            'message'   => 'required',
        ]);
        if ($request->status == 'Draft') {
            $request->receiver_id = Auth::user()->id;
            Message::create($request->all());
            return redirect()->route('messages.index', 'inbox')->with('success','Message saved successfully as draft!');
        }

        Message::create($request->all());
        
        if ($request->router) {
            return back()->with('success','Message sent succesfully!');
        }

        if ($request->router) {
            if ($type) {
                return redirect()->route($request->router, $type)->with('success','Message sent successfully!');
            }
            return redirect()->route($request->router, 'all')->with('success','Message sent successfully!');
        }
        return redirect()->route('messages.index', 'inbox')->with('success','Message sent successfully!');
    }

    /**
     * The message that comes from the unauthenticated users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function publicMessage(Request $request, $type=null)
    {
        request()->validate([
            'email'    => 'required',
            'fullname'  => 'required',
            'message'   => 'required',
        ]);
        if ($request->status == 'Draft') {
            $request->receiver = Auth::user()->id;
            Message::create($request->all());
            return redirect()->route('messages.index', 'inbox')->with('success','Message saved successfully as draft!');
        }
        $sendMessages = [];

        // getting guest account
        $guest_user = User::where('email','guest@mhospital.aviatosystems.com')->first();

        if (!$guest_user) {
            $guest_user = User::where('role','guest')->first();
        }

        if (!$guest_user) {
            return back()->with('danger', 'Message unsuccessful, feature unavailable. You can send to info@aviatosystems.com for help or register with us for free!');
        }

        // getting user receiver accounts
        // needs revision
        $users = User::where('role','admin')->orWhere('role','super-admin')->get();

        foreach ($users as $key => $user) {
            $msg    = [
                'sender_id'    =>  $guest_user->id,
                'receiver_id'  =>  $user->id,
                'folder'    =>  'urgent',
                'title'     =>  'Public Message: ' . $request->fullname . ', ' . $request->email,
                'message'   =>  $request->message . '

            
        ' . 'From: ' . $request->fullname . '
        ' . 'Email: ' . $request->email,
                'priority'  =>  'unseen',
                'status'    =>  $type,
            ];
            array_push($sendMessages, $msg);
        }

        foreach ($sendMessages as $key => $value) {
            Message::create($value);
        }

        return back()->with('success', 'Hey ' . explode(' ', trim($request->fullname))[0] . ', Your message has been sent successfully. We will get to you sooner enough!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAll(Request $request, $type=null)
    {
        request()->validate([
            'sender_id'    => 'required',
            'receiver_id'  => 'required',
            'message'   => 'required',
        ]);
        if ($request->status == 'Draft') {
            $request->receiver_id = Auth::user()->id;
            Message::create($request->all());
            return redirect()->route('messages.index', 'inbox')->with('success','Message saved successfully as draft!');
        }
        
        $sendMessages = [];

        $users = User::all();
        foreach ($users as $key => $user) {
            $msg    = [
                'sender_id'    =>  $request->sender_id,
                'receiver_id'  =>  $user->id,
                'folder'    =>  $request->folder,
                'title'     =>  $request->title,
                'message'   =>  $request->message,
                'priority'  =>  'unseen',
                'visibility'    =>  'group',
                'status'    =>  $request->status,
            ];
            array_push($sendMessages, $msg);
        }
        foreach ($sendMessages as $key => $value) {
            Message::create($value);
        }

        if ($request->router) {
            return redirect()->back()->with('success','Messages sent successfully!');
        }
        return redirect()->route('messages.index', 'inbox')->with('success','Messages sent successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message    = Message::find($id);
        $type       = 'inbox';
        
        if (!$message) {
            return redirect()->route('messages.index',$type)->with('danger', 'Message Not Found!');
        }

        if ($message->sender_id != Auth::user()->id && $message->receiver_id != Auth::user()->id) {
            return back()->with('warning','Access to resources not directed to you might lead to your account being suspense. Access Denied!');
        }

        $message_data = new Request();
        $message_data->allCount   = Message::where('sender_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->count();
        $message_data->inboxCount = Message::where([['status', 'inbox'],['receiver_id', Auth::user()->id]])->count();
        $message_data->trashCount = Message::where([['status', 'trash'],['receiver_id', Auth::user()->id]])->count();
        $message_data->draftCount = Message::where([['status', 'draft'],['sender_id', Auth::user()->id]])->count();
        $message_data->starredCount  = Message::where([['status', 'starred'],['receiver_id', Auth::user()->id]])->count();
        $message_data->sentCount  = Message::where('sender_id', Auth::user()->id)->whereNull('visibility')->count();
        $message_data->impCount   = Message::where([
            ['folder', 'important'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'important'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->urgCount   = Message::where([
            ['folder', 'urgent'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'urgent'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->offCount   = Message::where([
            ['folder', 'official'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'official'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->unoffCount = Message::where([
            ['folder', 'unofficial'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'unofficial'],
                ['receiver_id', Auth::user()->id]])->count();
        $message_data->normalCount= Message::where([
            ['folder', 'normal'],
            ['sender_id', Auth::user()->id]])->orWhere([
                ['folder', 'normal'],
                ['receiver_id', Auth::user()->id]])->count();

        $message_data->users      = User::latest()->get();

        if ($message->sender_id == Auth::user()->id) {
            return view('user.messages.show', compact('message_data'));
        }

        $message->update(['priority' => 'seen']);
        
        return view('user.messages.show', compact('message_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);
        if (!$message) {
            return redirect()->route('messages.index')->with('danger', 'Message not found!');
        }
        return view('user.message.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'sender_id'    =>  'required',
            'receiver_id'  =>  'required',
            'message'     =>  'required',
        ]);
        Message::find($id)->update($request->all());
        $type = 'inbox';
        return redirect()->route('messages.index','inbox')->with('success','Message updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Message::find($id);

        $item->delete();
        
        Message::where('message_id', $id)->delete();

        return redirect()->route('messages.index','inbox')->with('danger', 'Message Deleted Successfully');
    }
}
