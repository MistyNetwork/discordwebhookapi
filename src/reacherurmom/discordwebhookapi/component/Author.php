<?php

declare(strict_types=1);

namespace reacherurmom\discordwebhookapi\component;

final class Author {

	private function __construct(
		private string $name,
		private ?string $url,
		private ?string $icon
	) {}

	public static function create(string $name, ?string $url = null, ?string $icon = null) : self {
		return new self($name, $url, $icon);
	}

	public function setName(string $name) : self {
		$this->name = $name;
		return $this;
	}

	public function setUrl(?string $url) : self {
		$this->url = $url;
		return $this;
	}

	public function setIcon(?string $icon) : self {
		$this->icon = $icon;
		return $this;
	}

	public function serialize() : array {
		$data = [
			'name' => $this->name,
		];

		if ($this->url !== null) $data['url'] = $this->url;
		if ($this->icon !== null) $data['icon_url'] = $this->icon;
		return $data;
	}
}