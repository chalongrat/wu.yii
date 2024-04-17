<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&display=swap',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css',

        // 'theme/assets/plugins/bootstrap/css/bootstrap.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',

        // 'https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css',
        // 'https://cdn.datatables.net/fixedcolumns/4.0.2/css/fixedColumns.dataTables.min.css',
        'https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css',

        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css',
        'https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css',

        'https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css',
        'theme/assets/css/main.css',
        'theme/assets/css/theme1.css',
        'theme/assets/css/style-pd.css',
        'css/app.css',
    ];
    public $js = [
        'theme/assets/bundles/lib.vendor.bundle.js',
        'theme/assets/js/core.js',
        // 'https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js',

        'https://cdn.datatables.net/fixedcolumns/4.0.2/js/dataTables.fixedColumns.min.js',
        'https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js',
        'https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js',
        'https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js',
        'https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js',
        'https://cdn.jsdelivr.net/npm/sweetalert2@11',
        'js/staticRoute.js',
        'js/app.js',
        // 'app/js/route.js',

        'app/js/libButton.js',
        // 'js/libButton.js',
        'app/js/libAction.js',
        'app/js/libExportExcel.js',
        'app/js/libNameLabel.js',
        'js/helpers.js',
    ];
    public $depends = [];
}
