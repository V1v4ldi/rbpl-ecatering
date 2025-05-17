<div x-data="{ test: 'Hello Alpine!' }">
    <p x-text="test"></p>
</div>
<strong>Database Connected: </strong>
<?php
    try {
        \DB::connection()->getPDO();
        echo \DB::connection()->getDatabaseName();
        } catch (\Exception $e) {
        echo 'None';
    }
?>
