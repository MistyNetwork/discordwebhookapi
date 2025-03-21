<?php

declare(strict_types=1);

namespace reacherurmom\discordwebhookapi;

final class Message {

	private ?string $username = null;
	private ?string $content = null;
	private ?string $avatar = null;

	private bool $textToSpeech = false;

	/** @var array<Embed> */
	private array $embeds = [];

	public static function create() : self {
		return new self;
	}

	public function setUsername(?string $username) : self {
		$this->username = $username;
		return $this;
	}

	public function setContent(?string $content) : self {
		$this->content = $content;
		return $this;
	}

	public function setAvatar(?string $avatar) : self {
		$this->avatar = $avatar;
		return $this;
	}

	public function setTextToSpeech(bool $textToSpeech) : self {
		$this->textToSpeech = $textToSpeech;
		return $this;
	}

	public function addEmbed(Embed $embed) : self {
		$this->embeds[] = $embed;
		return $this;
	}

	public function serialize() : array {
		$data = [
			'tts' => $this->textToSpeech
		];

		if ($this->username !== null) $data['username'] = $this->username;
		if ($this->content !== null) $data['content'] = $this->content;
		if ($this->avatar !== null) $data['avatar_url'] = $this->avatar;
		if (count($this->embeds) > 0) $data['embeds'] = array_map(fn(Embed $embed) => $embed->serialize(), $this->embeds);
		return $data;
	}
}