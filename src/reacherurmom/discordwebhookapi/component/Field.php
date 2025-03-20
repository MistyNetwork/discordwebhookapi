<?php

declare(strict_types=1);

namespace reacherurmom\discordwebhookapi\component;

final class Field {

	private function __construct(
		private string $title,
		private string $content,
		private bool $inline
	) {}

	public static function create(string $title, string $content, bool $inline = true) : self {
		return new self($title, $content, $inline);
	}

	public function setTitle(string $title) : self {
		$this->title = $title;
		return $this;
	}

	public function setContent(string $content) : self {
		$this->content = $content;
		return $this;
	}

	public function setInline(bool $inline) : self {
		$this->inline = $inline;
		return $this;
	}

	public function serialize() : array {
		return [
			'name' => $this->title,
			'value' => $this->content,
			'inline' => $this->inline,
		];
	}
}