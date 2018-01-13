<?php

namespace App\Http\Controllers\API;

use App\Message;
use App\Repositories\MySQL\MessageRepository;
use App\Transformer\MessageTransformer;
use App\User;
use Illuminate\Database\Eloquent\Collection;
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
     * @param Request $request
     * @return JsonResponse|string
     */
    public function getMessagesOfConversation(Request $request)
    {

        $messages = $this->messageRepository
            ->getMessagesOfConversation($request);

        return $this->jsonCollection($messages, new MessageTransformer);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request) {
        $message = $this->messageRepository->createMessage($request);

        return $this->jsonCollection($message, new MessageTransformer);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id) {
        return $this->messageRepository->deleteMessage($id);
    }

    /**
     * @param Request $request
     * @return JsonResponse|string
     */
    public function getNewMessagesOfConversation(Request $request)
    {

        $messages = $this->messageRepository
            ->getNewMessagesOfConversation($request);

        return $this->jsonCollection($messages, new MessageTransformer);
    }
}
