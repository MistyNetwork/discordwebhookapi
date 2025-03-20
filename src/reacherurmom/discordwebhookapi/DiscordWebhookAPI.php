<?php

declare(strict_types=1);

namespace reacherurmom\discordwebhookapi;

use libasynCurl\Curl;

final class DiscordWebhookAPI {

	private function __construct(
		private readonly string $url,
		private readonly Message $message
	) {}

	public static function create(string $url, Message $message) : self {
		return new self($url, $message);
	}

	public function send() : void {
		Curl::postRequest(
			page: $this->url,
			args: $this->message->serialize(),
			headers: [
				'Content-Type: application/json',
			]
		);
	}
}
