<?php

namespace Chatify\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\ChMessage as Message;
use App\Models\ChFavorite as Favorite;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;

class MessagesController extends Controller
{
    protected $perPage = 30;

    public function pusherAuth(Request $request)
    {
        return Chatify::pusherAuth(
            $request->user(),
            Auth::user(),
            $request['channel_name'],
            $request['socket_id']
        );
    }

    public function index($id = null)
    {
        $user = Auth::user();
        $admin = User::where('role', 'admin')->first();

        if ($admin && $user && $id === null) {
            $checkExistingChat = Message::where(function ($query) use ($admin, $user) {
                $query->where('from_id', $user->id)->where('to_id', $admin->id);
            })->orWhere(function ($query) use ($admin, $user) {
                $query->where('from_id', $admin->id)->where('to_id', $user->id);
            })->exists();

            if (!$checkExistingChat) {
                Message::create([
                    'type' => 'text',
                    'from_id' => $user->id,
                    'to_id' => $admin->id,
                    'body' => 'Halo Admin, saya butuh bantuan!',
                    'seen' => 0,
                ]);
            }

            return redirect()->route('user.chat', ['id' => $admin->id]);
        }

        return view('Chatify::pages.app', [
            'id' => $id ?? 0,
            'messengerColor' => $user->messenger_color ? $user->messenger_color : Chatify::getFallbackColor(),
            'dark_mode' => $user->dark_mode < 1 ? 'light' : 'dark',
        ]);
    }
}
