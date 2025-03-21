<?php

declare(strict_types=1);

namespace reacherurmom\discordwebhookapi;

use reacherurmom\discordwebhookapi\component\Author;
use reacherurmom\discordwebhookapi\component\Field;
use reacherurmom\discordwebhookapi\component\Footer;

final class Embed {

	private ?string $description = null;
	private ?string $url = null;
	private ?int $color = null;

	private ?string $thumbnail = null;
	private ?string $image = null;

	private ?\DateTime $timestamp = null;
	private ?Author $author = null;
	private ?Footer $footer = null;

	/** @var array<Field> */
	private array $fields = [];

	private function __construct(
		private string $title
	) {}

	public static function create(string $title) : self {
		return new self($title);
	}

	public function setTitle(string $title) : self {
		$this->title = $title;
		return $this;
	}

	public function setDescription(?string $description) : self {
		$this->description = $description;
		return $this;
	}

	public function setUrl(?string $url) : self {
		$this->url = $url;
		return $this;
	}

	public function setColor(?int $color) : self {
		$this->color = $color;
		return $this;
	}

	public function setThumbnail(?string $thumbnail) : self {
		$this->thumbnail = $thumbnail;
		return $this;
	}

	public function setImage(?string $image) : self {
		$this->image = $image;
		return $this;
	}

	public function setTimestamp(?\DateTime $timestamp) : self {
		$this->timestamp = $timestamp;
		return $this;
	}

	public function setAuthor(?Author $author) : self {
		$this->author = $author;
		return $this;
	}

	public function setFooter(?Footer $footer) : self {
		$this->footer = $footer;
		return $this;
	}

	public function addField(Field $field) : self {
		$this->fields[] = $field;
		return $this;
	}

	public function serialize() : array {
		$data = [
			'title' => $this->title
		];

		if ($this->description !== null) $data['description'] = $this->description;
		if ($this->url !== null) $data['url'] = $this->url;
		if ($this->color !== null) $data['color'] = $this->color;
		if ($this->thumbnail !== null) $data['thumbnail'] = ['url' => $this->thumbnail];
		if ($this->image !== null) $data['image'] = ['url' => $this->image];

		if ($this->timestamp !== null) $data['timestamp'] = $this->timestamp->format('Y-m-d\TH:i:s.v\Z');
		if ($this->author !== null) $data['author'] = $this->author->serialize();
		if ($this->footer !== null) $data['footer'] = $this->footer->serialize();

		if (count($this->fields) > 0) $data['fields'] = array_map(fn (Field $field) => $field->serialize(), $this->fields);
		return $data;
	}
}