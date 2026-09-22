<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware($this->perm('message-table'))->only(['index', 'show']);
        $this->middleware($this->perm('message-delete'))->only(['destroy']);
    }

    public function index(Request $request)
    {
        $messages = ContactMessage::query()
            ->when($request->search, fn ($q, $s) => $q->where(fn ($q2) => $q2
                ->where('name', 'like', "%$s%")
                ->orWhere('email', 'like', "%$s%")
                ->orWhere('phone', 'like', "%$s%")
                ->orWhere('business_name', 'like', "%$s%")
                ->orWhere('message', 'like', "%$s%")))
            ->when($request->status === 'unread', fn ($q) => $q->where('is_read', false))
            ->when($request->status === 'read', fn ($q) => $q->where('is_read', true))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.messages.index', [
            'messages' => $messages,
            'total'    => ContactMessage::count(),
            'unread'   => ContactMessage::unread()->count(),
        ]);
    }

    public function show(int $id)
    {
        $message = ContactMessage::findOrFail($id);

        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(int $id)
    {
        ContactMessage::findOrFail($id)->delete();

        return redirect()->route('admin.message.index')->with('success', __('messages.deleted'));
    }
}
