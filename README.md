# acf-chart-block
# ACF Dynamic Chart Block

A custom ACF block for WordPress themes that lets editors create and display interactive charts. Built with Advanced Custom Fields PRO and Chart.js.

## Requirements

- WordPress 6.0 or higher
- Advanced Custom Fields PRO 6.0 or higher
- A WordPress theme

## Installation

1. Copy the `dynamic-chart` folder into your theme's `blocks` directory:
```
themes/your-theme/
└── blocks/
    └── dynamic-chart/
```

2. Add this code to your theme's `functions.php`:
```php
function register_acf_blocks() {
    register_block_type( get_template_directory() . '/blocks/dynamic-chart' );
    
    wp_enqueue_script(
        'chartjs',
        'https://cdn.jsdelivr.net/npm/chart.js',
        array(),
        '3.7.0',
        true
    );
}
add_action( 'init', 'register_acf_blocks' );
```

3. In WordPress admin, go to Custom Fields → Add New
4. Import the included ACF field group or create fields manually following the structure in the Field Configuration section below

## Features

- Multiple chart types (bar, line, pie, radar)
- Manual data entry with color picker
- CSV data upload
- Customizable settings (title, legend, animations)
- Live preview in the editor

## Usage

1. Create or edit a post/page
2. Add the "Dynamic Chart" block
3. Choose your chart type
4. Add data points manually or upload a CSV
5. Adjust settings as needed

## Field Configuration

If creating fields manually in ACF, you'll need:
- Chart Type (Select)
- Data Input Method (Radio Button)
- Data Points (Repeater for manual entry)
- CSV Upload (File field)
- Chart Settings (Group with title, legend, and animation options)

For exact field configuration, check the ACF export in `field-export.json`

## CSV Format
```csv
Label,Value
January,100
February,150
March,120
```

## Customization

- Edit `dynamic-chart.php` to modify the block's HTML structure
- Update `chart-logic.js` to change chart behavior
- Modify `dynamic-chart.css` to adjust styles

## Credits

- Built with [Advanced Custom Fields PRO](https://www.advancedcustomfields.com/pro/)
- Charts powered by [Chart.js](https://www.chartjs.org/)