# 🌍 DiscordWebhookAPI

**DiscordWebhookAPI** is an **asynchronous** **PocketMine-MP** library that allows sending messages and embeds to **Discord** using **webhooks** easily. It uses the [libasynCurl](https://github.com/NetherGamesMC/libasynCurl) library for handling asynchronous requests.

---

## 📌 API Registration

Before using the API, it's important to register the class to avoid conflicts with other plugins. If you do not check for registration, it will throw an exception.

```php

use reacherurmom\discordwebhookapi\DiscordWebhookAPI;
use pocketmine\plugin\PluginBase;

class MyMain extends PluginBase {

    protected function onEnable() : void {
        if (!DiscordWebhookAPI::isRegistered()) {
            DiscordWebhookAPI::register($this);
        }
    }
}
```

---

## 📜 Using Messages and Embeds

### 📌 Creating a Message

```php
use reacherurmom\discordwebhookapi\Message;

$message = Message::create()
    ->setUsername("ReacherUrMom Bot")
    ->setAvatar("https://example.com/avatar.png")
    ->setContent("Hi! This is my bot");
```

### 📌 Adding an Embed

```php
use reacherurmom\discordwebhookapi\Embed;

$embed = Embed::create()
    ->setTitle("Embed Title")
    ->setDescription("This is an embedded message.")
    ->setColor(0x00FF00);

$message->addEmbed($embed);
```

### 📌 Embed Methods

```php
use reacherurmom\discordwebhookapi\component\Footer;
use reacherurmom\discordwebhookapi\component\Author;
use reacherurmom\discordwebhookapi\component\Field;

$embed->setFooter(Footer::create("Footer Text", "https://example.com/footer.png"))
      ->setAuthor(Author::create("Author Name", "https://example.com/author.png"))
      ->setTimestamp(time())
      ->setThumbnail("https://example.com/thumbnail.png")
      ->addField(Field::create("Field 1", "Value of field 1", true))
      ->addField(Field::create("Field 2", "Value of field 2", false));
```

---

## 🚀 Sending the Message

```php
use reacherurmom\discordwebhookapi\DiscordWebhookAPI;

$webhook = "your_webhook_url";
DiscordWebhookAPI::create($webhook, $message)->send();
```

---

## 🙌 Credits

- [JuqnGOOOD]([https://github.com/user1](https://github.com/JkqzDev)
- [CortexPE]([https://github.com/user2](https://github.com/CortexPE/DiscordWebhookAPI)

---

## 📦 Adding the API to Your Project

You can install this API using **Composer**:

```sh
composer require reacherurmom/discordwebhookapi
```

---

## 📜 License

This project is **free to use**. For more details, check the [LICENSE](https://github.com/MistyNetwork/discordwebhookapi/blob/main/LICENSE).

