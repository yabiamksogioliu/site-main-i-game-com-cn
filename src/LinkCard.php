<?php

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private array $tags;

    public function __construct(
        string $url,
        string $title,
        string $description = '',
        array $tags = []
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->tags = $tags;
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');

        $html = '<div class="link-card">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">';
        $html .= '<h3 class="link-card-title">' . $escapedTitle . '</h3>';
        if ($this->description !== '') {
            $html .= '<p class="link-card-description">' . $escapedDesc . '</p>';
        }
        $html .= '</a>';
        if (!empty($this->tags)) {
            $html .= '<div class="link-card-tags">';
            foreach ($this->tags as $tag) {
                $escapedTag = htmlspecialchars($tag, ENT_QUOTES, 'UTF-8');
                $html .= '<span class="tag">' . $escapedTag . '</span>';
            }
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            $data['url'] ?? '',
            $data['title'] ?? '',
            $data['description'] ?? '',
            $data['tags'] ?? []
        );
    }
}

function renderLinkCard(string $url, string $title, string $description = '', array $tags = []): string
{
    $card = new LinkCard($url, $title, $description, $tags);
    return $card->render();
}

// Example usage
$sampleUrl = 'https://site-main-i-game.com.cn';
$sampleTitle = '爱游戏';
$sampleDescription = '探索爱游戏的最新动态与精彩内容';
$sampleTags = ['游戏', '娱乐', '爱游戏'];

echo renderLinkCard($sampleUrl, $sampleTitle, $sampleDescription, $sampleTags);