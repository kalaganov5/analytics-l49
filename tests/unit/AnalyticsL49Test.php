<?php
use PHPUnit\Framework\TestCase;

class AnalyticsL49Test extends TestCase {

    // Тест для функции analytics_l49_script_id_render
    public function testAnalyticsL49ScriptIdRender() {
        // Установка значения Script ID
        update_option('analytics_l49_script_id', 'test-id');

        // Запуск функции
        ob_start();
        analytics_l49_script_id_render();
        $content = ob_get_clean();

        // Проверка вывода
        $this->assertStringContainsString("value='test-id'", $content);
    }
}
