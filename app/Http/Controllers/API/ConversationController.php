<?php

namespace App\Http\Controllers\API;

use App\Repositories\MySQL\ConversationRepository;
use App\Transformer\ConversationTransformer;
use App\User;
use Illuminate\Support\Facades\Auth;
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
    public function index()
    {
        $user = new User;
        $user->id = 521;


        $conversations = $this->conversationRepository
            ->getUsersConversations($user);

        return $this->jsonCollection($conversations, new ConversationTransformer);
    }
}
