#!/bin/bash
git submodule init
git submodule update
cd doctrine2/
git submodule init
git submodule update
rm datas/tmp.db
php doctrine.php orm:schema-tool:create
chmod 777 datas/tmp.db
