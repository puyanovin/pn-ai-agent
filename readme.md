# PN AI Agent

A modern, lightweight and open-source AI Assistant plugin for WordPress.

PN AI Agent allows you to connect leading AI providers and build intelligent AI-powered chat experiences directly inside WordPress.

## Features

* OpenAI support
* Google Gemini support
* Ollama (Local AI) support
* Provider connection testing
* Automatic model loading
* AI chat interface
* Frontend chatbot
* Chat shortcode
* Gutenberg block
* Fast and lightweight
* Fully translatable (i18n)
* RTL support
* WordPress Coding Standards
* PHP 8.1+

## Supported Providers

### Free Edition

* OpenAI
* Google Gemini
* Ollama (Local AI)

Additional providers may be available in future editions.

## Requirements

* WordPress 6.5 or later
* PHP 8.1 or later

## Installation

### From WordPress

1. Upload the plugin to:

```
wp-content/plugins/pn-ai-agent
```

2. Activate the plugin.

3. Open **PN AI Agent** from the WordPress admin menu.

4. Select your AI provider.

5. Enter your API credentials.

6. Load available models.

7. Save your settings.

8. Add the chatbot using:

* Shortcode
* Gutenberg Block
* Widget

## Providers

### OpenAI

Create an API key from:

https://platform.openai.com/api-keys

### Google Gemini

Create an API key from:

https://aistudio.google.com/app/apikey

### Ollama

Install Ollama locally:

https://ollama.com

Default API URL:

```
http://localhost:11434/api
```

## Project Structure

```
assets/
languages/
src/
 ├── Admin/
 ├── Blocks/
 ├── Core/
 ├── Database/
 ├── Frontend/
 ├── Providers/
 └── Tools/
vendor/
```

## Development

Install Composer dependencies:

```bash
composer install
```

Generate translation template:

```bash
wp i18n make-pot . languages/pn-ai-agent.pot
```

## Security

* All AJAX requests are nonce protected.
* User capabilities are verified.
* WordPress escaping and sanitization functions are used throughout the project.

## Roadmap

Future releases may include:

* More AI providers
* MCP support
* AI Agents
* Knowledge Base
* Image Generation
* Conversation Memory
* RAG support
* Voice Chat
* Advanced Prompt Templates

## Contributing

Contributions, bug reports and feature requests are welcome.

Please read:

* CONTRIBUTING.md
* CODE_OF_CONDUCT.md
* SECURITY.md

## License

GPL-2.0-or-later

https://www.gnu.org/licenses/gpl-2.0.html

## Author

**PN Suite**

https://plugins.puyanovin.ir

---

Made with ❤️ for the WordPress community.

