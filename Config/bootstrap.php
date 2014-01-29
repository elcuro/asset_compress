<?php
Configure::write('Dispatcher.filters.asset_compress', 'AssetCompress.AssetCompressor');

Croogo::hookHelper('*', 'AssetCompress.AssetCompress');
