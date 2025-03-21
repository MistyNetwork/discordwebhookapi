<?php

declare(strict_types=1);

namespace reacherurmom\discordwebhookapi;

use libasynCurl\Curl;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\InternetRequestResult;
use SOFe\AwaitGenerator\Await;

final class DiscordWebhookAPI {

	private static ?PluginBase $registered = null;

	private function __construct(
		private readonly string $url,
		private readonly Message $message
	) {}

	public static function create(string $url, Message $message) : self {
		if (self::$registered === null) {
			throw new \RuntimeException('Library not registered.');
		}

		if (!filter_var($url, FILTER_VALIDATE_URL)) {
			throw new \RuntimeException('Webhook URL is not valid.');
		}
		return new self($url, $message);
	}

	public static function register(PluginBase $plugin) : void {
		if (self::$registered !== null) {
			throw new \RuntimeException('Library already registered. (classname=' . self::$registered::class . ')');
		}

		if (!Curl::isRegistered()) Curl::register($plugin);
		self::$registered = $plugin;
	}

	public function send() : void {
		Curl::postRequest(
			page: $this->url,
			args: $this->message->serialize(),
			headers: [
				'Content-Type: application/json',
			],
			closure: static function (?InternetRequestResult $result) : void {
				if ($result !== null) {
					if ($result->getCode() === 200 || $result->getCode() === 204) return;
					Server::getInstance()->getLogger()->info('DiscordWebhookAPI Error Code ' . $result->getCode() . '. (body=' . $result->getBody() . ' | headers=' . implode(', ', $result->getHeaders()) . ')');
				}
			}
		);
	}

	public function sendAsync() : \Generator {
		return yield Await::promise(fn(callable $resolve, callable $reject) => Curl::postRequest(
			page: $this->url,
			args: $this->message->serialize(),
			headers: [
				'Content-Type: application/json',
			],
			closure: static function (?InternetRequestResult $result) use ($resolve, $reject): void {
				if ($result !== null && !in_array($result->getCode(), [200, 204])) {
					$resolve(true);
				} else {
					$reject(throw new \RuntimeException('Error to send discord message. (code=' . $result?->getCode() . ')'));
				}
			}
		));
	}
}
