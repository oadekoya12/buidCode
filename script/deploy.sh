#!/bin/bash

# Three variable areas
# ----------------------
tmp="${HOMEPATH}/project/tmp"
branch=$1
cptodir=$2
# ----------------------

if [[ -d $tmp ]]; then
  cd $tmp
  if [[ ! -d repo ]]; then
    mkdir repo
  fi
  cd $tmp/repo
  echo -e changed directory to $(pwd)
fi

if [[ -d .git ]]; then
  if [[ -z $branch ]]; then
    git remote update origin --prune
    git branch -a
    echo -e "What branch do you want to deploy?"
    read -r branch
  fi
  if [[ `git branch -a | grep "remotes/origin/$branch"` ]]; then
    echo -e "$branch exist"
    git checkout $branch
  fi
else
  echo -e "Prune remote origin"
  echo -e ""
  git clone git+ssh://github.com/oadekoya12/buidCode.git .
  if [[  -z $branch ]]; then
    git remote update origin --prune
    git branch -a
    echo -e "What branch do you want to deploy?"
    read -r branch
  fi
  if [[ `git branch -a | grep "remotes/origin/$branch"` ]]; then
    echo -e "$branch exist"
    git checkout $branch
  fi
fi

# Copy Branch to destinated Directory
if [[ ! -z $cptodir ]]; then

  # ----------------------
  dest="${HOMEPATH}/project/web/www/$cptodir/wordpress"
  cd $dest
  dest=$(pwd)
  # ----------------------

  if [[ ! -d "$dest" ]]; then
    echo -e "The Destination Directory does not exist\n"
    echo -e "What is the site directory name?\n"
    read -r dest

    if [[ ! -d "$dest" ]] ; then echo "Destination directory doesn't exist"; exit; fi
  fi
else
  echo -e "What Destination Directory do you want to use?\n"
  read dest
  if [[ ! -d "$dest" ]] ; then echo "Destination directory doesn't exist"; exit; fi
fi

echo -e "Copy git content to $dest\n"
if [[ ! -d "$tmp/tmp/" ]] ; then mkdir "$tmp/tmp"; fi

# ----------------------
cd $tmp/tmp
newtmp="$(pwd)"
cd $tmp/repo
# ----------------------

if [[ -d  $tmp/repo/wordpress ]]; then
  "C:\Program Files\Git\usr\bin\tar" -c --exclude .git --exclude README "./wordpress" | "C:\Program Files\Git\usr\bin\tar"  -x -C "$newtmp"
  cd "$newtmp/wordpress"

  cp -ruvf "$(pwd)/"*  "$dest"
  cp -ruvf "$(pwd)/".*  "$dest"

  echo -e "Remove $tmp/repo $tmp/tmp"
  cd "$tmp/"
  rm -rf 'repo'
  rm -rf 'tmp'
fi
echo -e "Done."
