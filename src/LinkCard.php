<?php

/**
 * 链接卡片生成器
 * 
 * 生成安全转义后的卡片式HTML代码片段，
 * 用于在网页中展示带图标和描述的链接。
 */
class LinkCard
{
    /**
     * 渲染一个链接卡片
     *
     * @param string $title       卡片标题
     * @param string $url         目标链接
     * @param string $description 卡片描述文字
     * @param string $iconUrl     图标URL（可选）
     * @return string 转义后的HTML片段
     */
    public static function render($title, $url, $description = '', $iconUrl = '')
    {
        // 安全转义所有输出字段
        $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $safeUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        $safeDesc = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
        $safeIcon = htmlspecialchars($iconUrl, ENT_QUOTES, 'UTF-8');

        // 构建卡片HTML模板
        $html = '<div class="link-card">';
        $html .= '<a href="' . $safeUrl . '" target="_blank" rel="noopener noreferrer">';
        
        // 如果有图标URL则显示图标
        if ($safeIcon !== '') {
            $html .= '<img src="' . $safeIcon . '" alt="icon" class="link-card-icon">';
        }
        
        $html .= '<div class="link-card-content">';
        $html .= '<span class="link-card-title">' . $safeTitle . '</span>';
        
        // 如果有描述文字则显示
        if ($safeDesc !== '') {
            $html .= '<span class="link-card-description">' . $safeDesc . '</span>';
        }
        
        $html .= '</div>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    /**
     * 根据配置数组批量渲染链接卡片
     *
     * @param array $links 链接配置数组，每个元素包含 title, url, description, iconUrl
     * @return string 拼接后的HTML片段
     */
    public static function renderMultiple(array $links)
    {
        $output = '';
        foreach ($links as $link) {
            $title = isset($link['title']) ? $link['title'] : '';
            $url = isset($link['url']) ? $link['url'] : '#';
            $description = isset($link['description']) ? $link['description'] : '';
            $iconUrl = isset($link['iconUrl']) ? $link['iconUrl'] : '';

            $output .= self::render($title, $url, $description, $iconUrl);
        }
        return $output;
    }
}

// 示例用法
$sampleLinks = [
    [
        'title' => '爱游戏',
        'url' => 'https://web-home-aiyouxi.com.cn',
        'description' => '探索精彩的游戏世界',
        'iconUrl' => ''
    ],
    [
        'title' => '游戏攻略',
        'url' => 'https://web-home-aiyouxi.com.cn/guide',
        'description' => '最新最热的游戏攻略汇总',
        'iconUrl' => 'https://web-home-aiyouxi.com.cn/favicon.ico'
    ]
];

// 输出示例卡片（实际使用时可以echo）
// echo LinkCard::renderMultiple($sampleLinks);