<?php

declare(strict_types=1);

namespace reacherurmom\discordwebhookapi\component;

final class Footer {

	private function __construct(
		private string $text,
		private ?string $icon
	) {}

	public static function create(string $text, ?string $icon = null) : self {
		return new self($text, $icon);
	}

	public function setIcon(?string $icon) : self {
		$this->icon = $icon;
		return $this;
	}

	public function setText(string $text) : self {
		$this->text = $text;
		return $this;
	}

	public function serialize() : array {
		$data = [
			'text' => $this->text,
		];
		
		if ($this->icon !== null) $data['icon_url'] = $this->icon;
		return $data;
	}
}