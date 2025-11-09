<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ORM\Index(name: 'migrate_from_chat_id', columns: ['migrate_from_chat_id'])]
#[ORM\Index(name: 'migrate_to_chat_id', columns: ['migrate_to_chat_id'])]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $id = null {
        get {
            return $this->id;
        }
    }

    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'messages')]
    #[ORM\JoinColumn(name: 'chat_id', referencedColumnName: 'id', nullable: false)]
    private ?Chat $chat = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $sender_chat_id = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $message_thread_id = null;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'messages')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $sender_boost_count = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $date = null;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'forwaded_messages')]
    #[ORM\JoinColumn(name: 'forward_from', referencedColumnName: 'id', nullable: true)]
    private ?User $forward_from = null;

    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'forwaded_messages')]
    #[ORM\JoinColumn(name: 'forward_from_chat', referencedColumnName: 'id', nullable: true)]
    private ?Chat $forward_from_chat = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $forward_from_message_id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $forward_signature = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $forward_sender_name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $forward_date = null;

    #[ORM\Column]
    private ?bool $is_topic_message = null;

    #[ORM\Column]
    private ?bool $is_automatic_forward = null;

    #[ORM\ManyToOne(targetEntity: Chat::class, cascade: ['persist'], inversedBy: 'reply_to_chat')]
    #[ORM\JoinColumn(name: 'reply_to_chat', referencedColumnName: 'id', nullable: true)]
    private ?Chat $reply_to_chat = null;

    #[ORM\ManyToOne(targetEntity: Message::class, cascade: ['persist'], inversedBy: 'reply_to_message')]
    #[ORM\JoinColumn(name: 'reply_to_message', referencedColumnName: 'id', nullable: true)]
    private ?Message $reply_to_message = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $external_reply = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $quote = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $reply_to_story = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $via_bot = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $link_preview_options = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $edit_date = null;

    #[ORM\Column]
    private ?bool $has_protected_content = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $media_group_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $author_signature = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $entities = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $caption_entities = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $audio = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $document = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $animation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $game = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $photo = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $sticker = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $story = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $video = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $voice = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $video_note = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $caption = null;

    #[ORM\Column]
    private ?bool $has_media_spoiler = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contact = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $venue = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $poll = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $dice = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $new_chat_members = null;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'left_chats')]
    #[ORM\JoinColumn(name: 'left_chat_member', referencedColumnName: 'id', nullable: true)]
    private ?string $left_chat_member = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $new_chat_title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $new_chat_photo = null;

    #[ORM\Column]
    private ?bool $delete_chat_photo = null;

    #[ORM\Column]
    private ?bool $group_chat_created = null;

    #[ORM\Column]
    private ?bool $supergroup_chat_created = null;

    #[ORM\Column]
    private ?bool $channel_chat_created = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message_auto_delete_timer_changed = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $migrate_to_chat_id = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $migrate_from_chat_id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pinned_message = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $invoice = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $successful_payment = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $users_shared = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $chat_shared = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $connected_website = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $write_access_allowed = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $passport_data = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $proximity_alert_triggered = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $boost_added = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $forum_topic_created = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $forum_topic_edited = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $forum_topic_closed = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $forum_topic_reopened = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $general_forum_topic_hidden = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $general_forum_topic_unhidden = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video_chat_scheduled = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video_chat_started = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video_chat_ended = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video_chat_participants_invited = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $web_app_data = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $reply_markup = null;

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(Chat $chat): static
    {
        $this->chat = $chat;

        return $this;
    }

    public function getSenderChatId(): ?string
    {
        return $this->sender_chat_id;
    }

    public function setSenderChatId(string $sender_chat_id): static
    {
        $this->sender_chat_id = $sender_chat_id;

        return $this;
    }

    public function getMessageThreadId(): ?string
    {
        return $this->message_thread_id;
    }

    public function setMessageThreadId(?string $message_thread_id): static
    {
        $this->message_thread_id = $message_thread_id;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getSenderBoostCount(): ?string
    {
        return $this->sender_boost_count;
    }

    public function setSenderBoostCount(?string $sender_boost_count): static
    {
        $this->sender_boost_count = $sender_boost_count;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(?\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getForwardFrom(): ?User
    {
        return $this->forward_from;
    }

    public function setForwardFrom(?User $forward_from): static
    {
        $this->forward_from = $forward_from;

        return $this;
    }

    public function getForwardFromChat(): ?Chat
    {
        return $this->forward_from_chat;
    }

    public function setForwardFromChat(?Chat $forward_from_chat): static
    {
        $this->forward_from_chat = $forward_from_chat;

        return $this;
    }

    public function getForwardFromMessageId(): ?string
    {
        return $this->forward_from_message_id;
    }

    public function setForwardFromMessageId(?string $forward_from_message_id): static
    {
        $this->forward_from_message_id = $forward_from_message_id;

        return $this;
    }

    public function getForwardSignature(): ?string
    {
        return $this->forward_signature;
    }

    public function setForwardSignature(?string $forward_signature): static
    {
        $this->forward_signature = $forward_signature;

        return $this;
    }

    public function getForwardSenderName(): ?string
    {
        return $this->forward_sender_name;
    }

    public function setForwardSenderName(?string $forward_sender_name): static
    {
        $this->forward_sender_name = $forward_sender_name;

        return $this;
    }

    public function getForwardDate(): ?\DateTime
    {
        return $this->forward_date;
    }

    public function setForwardDate(?\DateTime $forward_date): static
    {
        $this->forward_date = $forward_date;

        return $this;
    }

    public function isTopicMessage(): ?bool
    {
        return $this->is_topic_message;
    }

    public function setIsTopicMessage(bool $is_topic_message): static
    {
        $this->is_topic_message = $is_topic_message;

        return $this;
    }

    public function isAutomaticForward(): ?bool
    {
        return $this->is_automatic_forward;
    }

    public function setIsAutomaticForward(bool $is_automatic_forward): static
    {
        $this->is_automatic_forward = $is_automatic_forward;

        return $this;
    }

    public function getReplyToChat(): ?Chat
    {
        return $this->reply_to_chat;
    }

    public function setReplyToChat(?Chat $reply_to_chat): static
    {
        $this->reply_to_chat = $reply_to_chat;

        return $this;
    }

    public function getReplyToMessage(): ?Message
    {
        return $this->reply_to_message;
    }

    public function setReplyToMessage(?Message $reply_to_message): static
    {
        $this->reply_to_message = $reply_to_message;

        return $this;
    }

    public function getExternalReply(): ?string
    {
        return $this->external_reply;
    }

    public function setExternalReply(?string $external_reply): static
    {
        $this->external_reply = $external_reply;

        return $this;
    }

    public function getQuote(): ?string
    {
        return $this->quote;
    }

    public function setQuote(?string $quote): static
    {
        $this->quote = $quote;

        return $this;
    }

    public function getReplyToStory(): ?string
    {
        return $this->reply_to_story;
    }

    public function setReplyToStory(?string $reply_to_story): static
    {
        $this->reply_to_story = $reply_to_story;

        return $this;
    }

    public function getViaBot(): ?string
    {
        return $this->via_bot;
    }

    public function setViaBot(?string $via_bot): static
    {
        $this->via_bot = $via_bot;

        return $this;
    }

    public function getLinkPreviewOptions(): ?string
    {
        return $this->link_preview_options;
    }

    public function setLinkPreviewOptions(?string $link_preview_options): static
    {
        $this->link_preview_options = $link_preview_options;

        return $this;
    }

    public function getEditDate(): ?\DateTime
    {
        return $this->edit_date;
    }

    public function setEditDate(?\DateTime $edit_date): static
    {
        $this->edit_date = $edit_date;

        return $this;
    }

    public function hasProtectedContent(): ?bool
    {
        return $this->has_protected_content;
    }

    public function setHasProtectedContent(bool $has_protected_content): static
    {
        $this->has_protected_content = $has_protected_content;

        return $this;
    }

    public function getMediaGroupId(): ?string
    {
        return $this->media_group_id;
    }

    public function setMediaGroupId(string $media_group_id): static
    {
        $this->media_group_id = $media_group_id;

        return $this;
    }

    public function getAuthorSignature(): ?string
    {
        return $this->author_signature;
    }

    public function setAuthorSignature(string $author_signature): static
    {
        $this->author_signature = $author_signature;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getEntities(): ?string
    {
        return $this->entities;
    }

    public function setEntities(string $entities): static
    {
        $this->entities = $entities;

        return $this;
    }

    public function getCaptionEntities(): ?string
    {
        return $this->caption_entities;
    }

    public function setCaptionEntities(string $caption_entities): static
    {
        $this->caption_entities = $caption_entities;

        return $this;
    }

    public function getAudio(): ?string
    {
        return $this->audio;
    }

    public function setAudio(string $audio): static
    {
        $this->audio = $audio;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(string $document): static
    {
        $this->document = $document;

        return $this;
    }

    public function getAnimation(): ?string
    {
        return $this->animation;
    }

    public function setAnimation(string $animation): static
    {
        $this->animation = $animation;

        return $this;
    }

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(string $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getSticker(): ?string
    {
        return $this->sticker;
    }

    public function setSticker(string $sticker): static
    {
        $this->sticker = $sticker;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(string $story): static
    {
        $this->story = $story;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): static
    {
        $this->video = $video;

        return $this;
    }

    public function getVoice(): ?string
    {
        return $this->voice;
    }

    public function setVoice(string $voice): static
    {
        $this->voice = $voice;

        return $this;
    }

    public function getVideoNote(): ?string
    {
        return $this->video_note;
    }

    public function setVideoNote(string $video_note): static
    {
        $this->video_note = $video_note;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): static
    {
        $this->caption = $caption;

        return $this;
    }

    public function hasMediaSpoiler(): ?bool
    {
        return $this->has_media_spoiler;
    }

    public function setHasMediaSpoiler(bool $has_media_spoiler): static
    {
        $this->has_media_spoiler = $has_media_spoiler;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getVenue(): ?string
    {
        return $this->venue;
    }

    public function setVenue(string $venue): static
    {
        $this->venue = $venue;

        return $this;
    }

    public function getPoll(): ?string
    {
        return $this->poll;
    }

    public function setPoll(string $poll): static
    {
        $this->poll = $poll;

        return $this;
    }

    public function getDice(): ?string
    {
        return $this->dice;
    }

    public function setDice(string $dice): static
    {
        $this->dice = $dice;

        return $this;
    }

    public function getNewChatMembers(): ?string
    {
        return $this->new_chat_members;
    }

    public function setNewChatMembers(string $new_chat_members): static
    {
        $this->new_chat_members = $new_chat_members;

        return $this;
    }

    public function getLeftChatMember(): ?string
    {
        return $this->left_chat_member;
    }

    public function setLeftChatMember(?string $left_chat_member): static
    {
        $this->left_chat_member = $left_chat_member;

        return $this;
    }

    public function getNewChatTitle(): ?string
    {
        return $this->new_chat_title;
    }

    public function setNewChatTitle(?string $new_chat_title): static
    {
        $this->new_chat_title = $new_chat_title;

        return $this;
    }

    public function getNewChatPhoto(): ?string
    {
        return $this->new_chat_photo;
    }

    public function setNewChatPhoto(string $new_chat_photo): static
    {
        $this->new_chat_photo = $new_chat_photo;

        return $this;
    }

    public function isDeleteChatPhoto(): ?bool
    {
        return $this->delete_chat_photo;
    }

    public function setDeleteChatPhoto(bool $delete_chat_photo): static
    {
        $this->delete_chat_photo = $delete_chat_photo;

        return $this;
    }

    public function isGroupChatCreated(): ?bool
    {
        return $this->group_chat_created;
    }

    public function setGroupChatCreated(bool $group_chat_created): static
    {
        $this->group_chat_created = $group_chat_created;

        return $this;
    }

    public function isSupergroupChatCreated(): ?bool
    {
        return $this->supergroup_chat_created;
    }

    public function setSupergroupChatCreated(bool $supergroup_chat_created): static
    {
        $this->supergroup_chat_created = $supergroup_chat_created;

        return $this;
    }

    public function isChannelChatCreated(): ?bool
    {
        return $this->channel_chat_created;
    }

    public function setChannelChatCreated(bool $channel_chat_created): static
    {
        $this->channel_chat_created = $channel_chat_created;

        return $this;
    }

    public function getMessageAutoDeleteTimerChanged(): ?string
    {
        return $this->message_auto_delete_timer_changed;
    }

    public function setMessageAutoDeleteTimerChanged(string $message_auto_delete_timer_changed): static
    {
        $this->message_auto_delete_timer_changed = $message_auto_delete_timer_changed;

        return $this;
    }

    public function getMigrateToChatId(): ?string
    {
        return $this->migrate_to_chat_id;
    }

    public function setMigrateToChatId(?string $migrate_to_chat_id): static
    {
        $this->migrate_to_chat_id = $migrate_to_chat_id;

        return $this;
    }

    public function getMigrateFromChatId(): ?string
    {
        return $this->migrate_from_chat_id;
    }

    public function setMigrateFromChatId(?string $migrate_from_chat_id): static
    {
        $this->migrate_from_chat_id = $migrate_from_chat_id;

        return $this;
    }

    public function getPinnedMessage(): ?string
    {
        return $this->pinned_message;
    }

    public function setPinnedMessage(?string $pinned_message): static
    {
        $this->pinned_message = $pinned_message;

        return $this;
    }

    public function getInvoice(): ?string
    {
        return $this->invoice;
    }

    public function setInvoice(?string $invoice): static
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getSuccessfulPayment(): ?string
    {
        return $this->successful_payment;
    }

    public function setSuccessfulPayment(?string $successful_payment): static
    {
        $this->successful_payment = $successful_payment;

        return $this;
    }

    public function getUsersShared(): ?string
    {
        return $this->users_shared;
    }

    public function setUsersShared(?string $users_shared): static
    {
        $this->users_shared = $users_shared;

        return $this;
    }

    public function getChatShared(): ?string
    {
        return $this->chat_shared;
    }

    public function setChatShared(?string $chat_shared): static
    {
        $this->chat_shared = $chat_shared;

        return $this;
    }

    public function getConnectedWebsite(): ?string
    {
        return $this->connected_website;
    }

    public function setConnectedWebsite(?string $connected_website): static
    {
        $this->connected_website = $connected_website;

        return $this;
    }

    public function getWriteAccessAllowed(): ?string
    {
        return $this->write_access_allowed;
    }

    public function setWriteAccessAllowed(?string $write_access_allowed): static
    {
        $this->write_access_allowed = $write_access_allowed;

        return $this;
    }

    public function getPassportData(): ?string
    {
        return $this->passport_data;
    }

    public function setPassportData(?string $passport_data): static
    {
        $this->passport_data = $passport_data;

        return $this;
    }

    public function getProximityAlertTriggered(): ?string
    {
        return $this->proximity_alert_triggered;
    }

    public function setProximityAlertTriggered(?string $proximity_alert_triggered): static
    {
        $this->proximity_alert_triggered = $proximity_alert_triggered;

        return $this;
    }

    public function getBoostAdded(): ?string
    {
        return $this->boost_added;
    }

    public function setBoostAdded(?string $boost_added): static
    {
        $this->boost_added = $boost_added;

        return $this;
    }

    public function getForumTopicCreated(): ?string
    {
        return $this->forum_topic_created;
    }

    public function setForumTopicCreated(?string $forum_topic_created): static
    {
        $this->forum_topic_created = $forum_topic_created;

        return $this;
    }

    public function getForumTopicEdited(): ?string
    {
        return $this->forum_topic_edited;
    }

    public function setForumTopicEdited(?string $forum_topic_edited): static
    {
        $this->forum_topic_edited = $forum_topic_edited;

        return $this;
    }

    public function getForumTopicClosed(): ?string
    {
        return $this->forum_topic_closed;
    }

    public function setForumTopicClosed(?string $forum_topic_closed): static
    {
        $this->forum_topic_closed = $forum_topic_closed;

        return $this;
    }

    public function getForumTopicReopened(): ?string
    {
        return $this->forum_topic_reopened;
    }

    public function setForumTopicReopened(?string $forum_topic_reopened): static
    {
        $this->forum_topic_reopened = $forum_topic_reopened;

        return $this;
    }

    public function getGeneralForumTopicHidden(): ?string
    {
        return $this->general_forum_topic_hidden;
    }

    public function setGeneralForumTopicHidden(?string $general_forum_topic_hidden): static
    {
        $this->general_forum_topic_hidden = $general_forum_topic_hidden;

        return $this;
    }

    public function getGeneralForumTopicUnhidden(): ?string
    {
        return $this->general_forum_topic_unhidden;
    }

    public function setGeneralForumTopicUnhidden(?string $general_forum_topic_unhidden): static
    {
        $this->general_forum_topic_unhidden = $general_forum_topic_unhidden;

        return $this;
    }

    public function getVideoChatScheduled(): ?string
    {
        return $this->video_chat_scheduled;
    }

    public function setVideoChatScheduled(?string $video_chat_scheduled): static
    {
        $this->video_chat_scheduled = $video_chat_scheduled;

        return $this;
    }

    public function getVideoChatStarted(): ?string
    {
        return $this->video_chat_started;
    }

    public function setVideoChatStarted(?string $video_chat_started): static
    {
        $this->video_chat_started = $video_chat_started;

        return $this;
    }

    public function getVideoChatEnded(): ?string
    {
        return $this->video_chat_ended;
    }

    public function setVideoChatEnded(?string $video_chat_ended): static
    {
        $this->video_chat_ended = $video_chat_ended;

        return $this;
    }

    public function getVideoChatParticipantsInvited(): ?string
    {
        return $this->video_chat_participants_invited;
    }

    public function setVideoChatParticipantsInvited(?string $video_chat_participants_invited): static
    {
        $this->video_chat_participants_invited = $video_chat_participants_invited;

        return $this;
    }

    public function getWebAppData(): ?string
    {
        return $this->web_app_data;
    }

    public function setWebAppData(?string $web_app_data): static
    {
        $this->web_app_data = $web_app_data;

        return $this;
    }

    public function getReplyMarkup(): ?string
    {
        return $this->reply_markup;
    }

    public function setReplyMarkup(?string $reply_markup): static
    {
        $this->reply_markup = $reply_markup;

        return $this;
    }
}
