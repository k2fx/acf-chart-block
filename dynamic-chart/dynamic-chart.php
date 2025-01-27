<?php
/**
 * Dynamic Chart Block Template
 */

// Create id attribute
$id = 'dynamic-chart-' . $block['id'];
if(!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute
$className = 'dynamic-chart';
if(!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

// Load field values
$chart_type = get_field('chart_type') ?: 'bar';
$data_input_method = get_field('data_input_method');
$chart_settings = get_field('chart_settings');

// Prepare data array
$chart_data = array();
$chart_labels = array();
$chart_colors = array();

if($data_input_method === 'manual') {
    if($data_points = get_field('data_points')) {
        foreach($data_points as $point) {
            $chart_labels[] = esc_html($point['label']);
            $chart_data[] = floatval($point['value']);
            $chart_colors[] = esc_html($point['color']);
        }
    }
} elseif($data_input_method === 'csv') {
    $csv_file = get_field('csv_file');
    if($csv_file) {
        $csv_content = file_get_contents($csv_file['url']);
        $rows = array_map('str_getcsv', explode("\n", $csv_content));
        foreach($rows as $row) {
            if(isset($row[0]) && isset($row[1])) {
                $chart_labels[] = esc_html($row[0]);
                $chart_data[] = floatval($row[1]);
                $chart_colors[] = '#' . substr(md5($row[0]), 0, 6); // Generate color from label
            }
        }
    }
}

// Prepare data for JavaScript
$chart_config = array(
    'type' => $chart_type,
    'data' => array(
        'labels' => $chart_labels,
        'values' => $chart_data,
        'colors' => $chart_colors
    ),
    'settings' => array(
        'title' => $chart_settings['title'],
        'showLegend' => $chart_settings['show_legend'],
        'animation' => $chart_settings['animation']
    )
);
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <canvas class="chart-canvas" data-chart='<?php echo esc_attr(json_encode($chart_config)); ?>'></canvas>
</div>