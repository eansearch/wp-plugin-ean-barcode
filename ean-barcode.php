<?php
/**
 * Plugin Name: EAN Barcodes
 * Plugin URI:  https://www.ean-search.org/
 * Description: Plugin to easily display product barcodes in Worpress
 * Version:     1.1
 * Author:      EAN-Search.org
 * Author URI:  https://www.ean-search.org/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    die("No direct access!");
};

function eansearch_barcode_shortcode($atts = [], $content = null, $tag = '')
{
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    $barcode_atts = shortcode_atts(array(
        'ean' => 'code',
        'upc' => 'code',
        'gtin' => 'code',
    ), $atts, $tag);
    $ean = '0000000000000';
    if (strlen($barcode_atts['upc']) == 12) {
        $ean = '0' . $barcode_atts['upc'];
    }
    if (strlen($barcode_atts['gtin']) == 14) {
        $ean = substr($barcode_atts['gtin'], 1);
    }
    if (strlen($barcode_atts['ean']) == 13) {
        $ean = $barcode_atts['ean'];
    }
    return "<a href='https://www.ean-search.org/?q=$ean' target=_blank><img width='102' height='50' hspace='4' vspace='4' src='https://www.ean-search.org/barcode/$ean' border=0></a>";
}

add_shortcode('barcode', 'eansearch_barcode_shortcode');

