<?php

function folderSize ($dir) {
    $size = 0;

    foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : folderSize($each);
    }

    return $size;
}

function filesSummary ($dir) {
    $data = [
        'dirs' => 0,
        'files' => 0,
        'size' => 0,
        'tree' => [],
    ];

    $tree = glob(rtrim($dir, '/').'/*', GLOB_NOSORT);

    array_push($data['tree'], $tree);


    foreach ($tree as $each) {

        if(is_file($each)) {
            $data['size'] += filesize($each);
            $data['files']++;
        }
        else {
            $_data = filesSummary($each);
            $data['size'] += $_data['size'];
            $data['dirs'] += $_data['dirs'];
            $data['files'] += $_data['files'];

            print_r($_data);
        }

        
    }

    return $data;
}

function humanSize ($size) {
	if($size<1024){$size=$size." Bytes";}
	elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
	elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
	else{$size=round($size/1073741824, 1)." GB";}
	return $size;
}

function sizeFilter($bytes) {
    $label = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

    for ($i = 0; $bytes >= 1024 && $i < (count($label) - 1); $bytes /= 1024, $i++) ;

    return (round($bytes, 2) . " " . $label[$i]);
}

$dir = __DIR__;
$dir = 'testowy';
$summary = filesSummary($dir);

echo "\n\n*****\n\nTree: ";
$tree = glob(rtrim($dir, '/').'/*', GLOB_NOSORT);
print_r($tree);



echo "\n\n*****\n\nStatystyki {$dir}";
$summary['size'] = sizeFilter($summary['size']);
print_r($summary);
$size = folderSize($dir);
echo "\nSize: " . humanSize($size);
echo "\nSize: " . sizeFilter($size);