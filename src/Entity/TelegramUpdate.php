<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TelegramUpdateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelegramUpdateRepository::class)]
class TelegramUpdate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null;

    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'chat_id', referencedColumnName: 'id', nullable: false)]
    private ?Chat $chat = null;

    #[ORM\ManyToOne(targetEntity: Message::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'message_id', referencedColumnName: 'id', nullable: false)]
    private ?Message $message = null;

    #[ORM\ManyToOne(targetEntity: EditedMessage::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'edited_message_id', referencedColumnName: 'id', nullable: false)]
    private ?EditedMessage $edited_message = null;

    #[ORM\ManyToOne(targetEntity: Message::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'channel_post_id', referencedColumnName: 'id', nullable: false)]
    private ?Message $channel_post = null;

    #[ORM\ManyToOne(targetEntity: EditedMessage::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'edited_channel_post_id', referencedColumnName: 'id', nullable: false)]
    private ?EditedMessage $edited_channel_post = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $message_reaction_id = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $message_reaction_count_id = null;

    #[ORM\ManyToOne(targetEntity: InlineQuery::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'inline_query_id', referencedColumnName: 'id', nullable: false)]
    private ?InlineQuery $inline_query = null;

    #[ORM\ManyToOne(targetEntity: ChosenInlineResult::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'chosen_inline_result_id', referencedColumnName: 'id', nullable: false)]
    private ?ChosenInlineResult $chosen_inline_result = null;

    #[ORM\ManyToOne(targetEntity: CallbackQuery::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'callback_query_id', referencedColumnName: 'id', nullable: false)]
    private ?CallbackQuery $callback_query = null;

    #[ORM\ManyToOne(targetEntity: ShippingQuery::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'shipping_query_id', referencedColumnName: 'id', nullable: false)]
    private ?ShippingQuery $shipping_query = null;

    #[ORM\ManyToOne(targetEntity: PreCheckoutQuery::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'pre_checkout_query_id', referencedColumnName: 'id', nullable: false)]
    private ?PreCheckoutQuery $pre_checkout_query_id = null;

    #[ORM\ManyToOne(targetEntity: Poll::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'poll_id', referencedColumnName: 'id', nullable: false)]
    private ?Poll $poll = null;

    #[ORM\ManyToOne(targetEntity: PollAnswer::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'poll_answer_poll_id', referencedColumnName: 'poll_id', nullable: false)]
    private ?string $poll_answer_poll_id = null;

    #[ORM\ManyToOne(targetEntity: ChatMemberUpdated::class, cascade: ['persist'], inversedBy: 'TelegramUpdatesMy')]
    #[ORM\JoinColumn(name: 'my_chat_member_updated_id', referencedColumnName: 'id', nullable: false)]
    private ?ChatMemberUpdated $my_chat_member_updated = null;

    #[ORM\ManyToOne(targetEntity: ChatMemberUpdated::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'chat_member_updated_id', referencedColumnName: 'id', nullable: false)]
    private ?ChatMemberUpdated $chat_member_updated_id = null;

    #[ORM\ManyToOne(targetEntity: ChatJoinRequest::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'chat_join_request_id', referencedColumnName: 'id', nullable: false)]
    private ?ChatJoinRequest $chat_join_request = null;

    #[ORM\ManyToOne(targetEntity: ChatBoostUpdated::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'chat_member_updated_id', referencedColumnName: 'id', nullable: false)]
    private ?ChatBoostUpdated $chat_boost_updated_id = null;

    #[ORM\ManyToOne(targetEntity: ChatBoostRemoved::class, cascade: ['persist'], inversedBy: 'TelegramUpdates')]
    #[ORM\JoinColumn(name: 'chat_boost_removed_id', referencedColumnName: 'id', nullable: false)]
    private ?ChatBoostRemoved $chat_boost_removed_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(?Chat $chat): static
    {
        $this->chat = $chat;

        return $this;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function setMessage(?Message $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getEditedMessage(): ?EditedMessage
    {
        return $this->edited_message;
    }

    public function setEditedMessage(?EditedMessage $edited_message): static
    {
        $this->edited_message = $edited_message;

        return $this;
    }

    public function getChannelPost(): ?Message
    {
        return $this->channel_post;
    }

    public function setChannelPost(?Message $channel_post): static
    {
        $this->channel_post = $channel_post;

        return $this;
    }

    public function getEditedChannelPost(): ?EditedMessage
    {
        return $this->edited_channel_post;
    }

    public function setEditedChannelPost(?EditedMessage $edited_channel_post): static
    {
        $this->edited_channel_post = $edited_channel_post;

        return $this;
    }

    public function getMessageReactionId(): ?string
    {
        return $this->message_reaction_id;
    }

    public function setMessageReactionId(?string $message_reaction_id): static
    {
        $this->message_reaction_id = $message_reaction_id;

        return $this;
    }

    public function getMessageReactionCountId(): ?string
    {
        return $this->message_reaction_count_id;
    }

    public function setMessageReactionCountId(?string $message_reaction_count_id): static
    {
        $this->message_reaction_count_id = $message_reaction_count_id;

        return $this;
    }

    public function getInlineQuery(): ?InlineQuery
    {
        return $this->inline_query;
    }

    public function setInlineQuery(?InlineQuery $inline_query): static
    {
        $this->inline_query = $inline_query;

        return $this;
    }

    public function getChosenInlineResult(): ?ChosenInlineResult
    {
        return $this->chosen_inline_result;
    }

    public function setChosenInlineResult(?ChosenInlineResult $chosen_inline_result): static
    {
        $this->chosen_inline_result = $chosen_inline_result;

        return $this;
    }

    public function getCallbackQuery(): ?CallbackQuery
    {
        return $this->callback_query;
    }

    public function setCallbackQuery(?CallbackQuery $callback_query): static
    {
        $this->callback_query = $callback_query;

        return $this;
    }

    public function getShippingQuery(): ?ShippingQuery
    {
        return $this->shipping_query;
    }

    public function setShippingQuery(?ShippingQuery $shipping_query): static
    {
        $this->shipping_query = $shipping_query;

        return $this;
    }

    public function getPreCheckoutQueryId(): ?PreCheckoutQuery
    {
        return $this->pre_checkout_query_id;
    }

    public function setPreCheckoutQueryId(?PreCheckoutQuery $pre_checkout_query_id): static
    {
        $this->pre_checkout_query_id = $pre_checkout_query_id;

        return $this;
    }

    public function getPoll(): ?Poll
    {
        return $this->poll;
    }

    public function setPoll(?Poll $poll): static
    {
        $this->poll = $poll;

        return $this;
    }

    public function getPollAnswerPollId(): ?string
    {
        return $this->poll_answer_poll_id;
    }

    public function setPollAnswerPollId(?string $poll_answer_poll_id): static
    {
        $this->poll_answer_poll_id = $poll_answer_poll_id;

        return $this;
    }

    public function getMyChatMemberUpdated(): ?ChatMemberUpdated
    {
        return $this->my_chat_member_updated;
    }

    public function setMyChatMemberUpdated(?ChatMemberUpdated $my_chat_member_updated): static
    {
        $this->my_chat_member_updated = $my_chat_member_updated;

        return $this;
    }

    public function getChatMemberUpdatedId(): ?ChatMemberUpdated
    {
        return $this->chat_member_updated_id;
    }

    public function setChatMemberUpdatedId(?ChatMemberUpdated $chat_member_updated_id): static
    {
        $this->chat_member_updated_id = $chat_member_updated_id;

        return $this;
    }

    public function getChatJoinRequest(): ?ChatJoinRequest
    {
        return $this->chat_join_request;
    }

    public function setChatJoinRequest(?ChatJoinRequest $chat_join_request): static
    {
        $this->chat_join_request = $chat_join_request;

        return $this;
    }

    public function getChatBoostUpdatedId(): ?ChatBoostUpdated
    {
        return $this->chat_boost_updated_id;
    }

    public function setChatBoostUpdatedId(?ChatBoostUpdated $chat_boost_updated_id): static
    {
        $this->chat_boost_updated_id = $chat_boost_updated_id;

        return $this;
    }

    public function getChatBoostRemovedId(): ?ChatBoostRemoved
    {
        return $this->chat_boost_removed_id;
    }

    public function setChatBoostRemovedId(?ChatBoostRemoved $chat_boost_removed_id): static
    {
        $this->chat_boost_removed_id = $chat_boost_removed_id;

        return $this;
    }
}
