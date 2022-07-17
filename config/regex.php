<?php
/**
 * Created by VS Code.
 * User: Araf
 * Date: 2/22/22
 * Time: 4:55 PM
 */

return [
    'en' => '^([\u0000-\u00FF])+$',
    'bn' => '^([\u0980-\u09FF\u0000\u0009\u000A\u000B\u000C\u000D\u0020-\u002F\u0020\u002D\u003A-\u0040\u005B-\u0060\u007B-\u0081|[\।])+$',
    'fax' => '^(\+?[0-9\u002D\u00B1\u0028\u0029])+$',
    'number' => '^([\u0065\u002B\u002D])+$',
];