<?php

namespace App\Http\Controllers\API;

use App\Repositories\MySQL\MessageRepository;
use App\Transformer\MessageTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Class MessageController
 * @package App\Http\Controllers\API
 */
class MessageController extends BaseController
{
    /**
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     * MessageController constructor.
     */
    public function __construct()
    {
        $this->messageRepository = app(MessageRepository::class);

        parent::__construct();
    }

    /**
     * @return JsonResponse|string
     */
    public function getMessagesOfConversation(Request $request)
    {
        $user = User::find($request->user);

        $messages = $this->messageRepository
            ->getMessagesOfConversation($request, $user);

        return $this->jsonCollection($messages, new MessageTransformer);
    }
}
