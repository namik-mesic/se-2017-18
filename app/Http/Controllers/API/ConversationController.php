<?php

namespace App\Http\Controllers\API;

use App\Repositories\MySQL\ConversationRepository;
use App\Transformer\ConversationTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Class ConversationController
 * @package App\Http\Controllers\API
 */
class ConversationController extends BaseController
{
    /**
     * @var ConversationRepository
     */
    private $conversationRepository;

    /**
     * ConversationController constructor.
     */
    public function __construct()
    {
        $this->conversationRepository = app(ConversationRepository::class);

        parent::__construct();
    }

    /**
     * @return JsonResponse|string
     */
    public function index(Request $request)
    {
        $user = User::find($request->id);

        $conversations = $this->conversationRepository
            ->getUsersConversations($request, $user);

        return $this->jsonCollection($conversations, new ConversationTransformer);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getConversationWithUser(Request $request) {

        $user = User::find($request->authUser);

        $conversation = $this->conversationRepository
            ->getConversationWithUser($request, $user);

        return $this->jsonCollection($conversation, new ConversationTransformer);
    }
}
