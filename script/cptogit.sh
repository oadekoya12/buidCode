#!/bin/bash
# dest="${HOMEPATH}/project/buidCode/wordpress"
# src="${HOMEPATH}/project/web/www/stb/wordpress"

dest="/c/Users/olawa/project/buidCode/wordpress"
src="/c/Users/olawa/project/web/www/stb/wordpress"

# cd "$src"
rsync -arv  --inplace --progresss --exclude="wp-config.php" --exclude="wordpress/wp-content/debug.log" "wordpress/wp-content/uploads"  "$src" "$dest"
