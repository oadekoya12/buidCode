#!/bin/bash

cd "C:\www\env\repo"
cPWD=$(pwd)
echo "Change directory to " $cPWD

REPO="origin"


if [[ -d .git ]]; then
  echo -e "Prune remote origin"
  git remote update origin --prune
  echo -e "Remote branch."
  git branch -a
  echo -e "local branch."
  git branch
else
  git clone git+ssh://git-codecommit.us-east-1.amazonaws.com/v1/repos/stbwprepo .
fi

if [[ -z $1 ]]; then
  echo -e "What branch are you getting?"
  read branch
  git ls-remote --heads ${REPO} ${branch} | grep ${branch} >/dev/null
  if [ "$?" == "1" ] ; then echo "Branch doesn't exist"; exit; fi
else
  git ls-remote --heads ${REPO} ${1} | grep ${1} >/dev/null
  if [ "$?" == "1" ] ; then
    echo -e "Branch doesn't exist\n"
    echo -e "What branch are you getting?"
    read branch
    git ls-remote --heads ${REPO} ${branch} | grep ${branch} >/dev/null
    if [ "$?" == "1" ] ; then echo "Branch doesn't exist"; exit; fi
  fi
fi

if [ -d "$cPWD/.git" ]; then
  if [ ! -z "$branch" ]; then
    git checkout $branch
  fi
fi

cd 'C:\www\env\'
wwwroot=$(pwd)


if [[ ! -z $2 ]]; then
  dest="$wwwroot/$2/wordpress"
  if [[ ! -d "$dest" ]]; then
    echo -e "The Destination Directory does not exist\n"
    echo -e "What is the site directory name?\n"
    read dest
    dest="$wwwroot/$dest/wordpress"
    if [[ ! -d "$dest" ]] ; then echo "Destination directory doesn't exist"; exit; fi
  fi
else
  echo -e "What Destination Directory do you want to use?\n"
  read dest
  dest="$wwwroot/$dest/wordpress"
  if [[ ! -d "$dest" ]] ; then echo "Destination directory doesn't exist"; exit; fi
fi
# cd 'C:\www\env\tmp'
# dest=$(pwd)
cd "$cPWD"
echo -e "Copy git content to $dest\n"

#make tmp directory
tmp="$wwwroot/tmp"
if [[ ! -d "$tmp" ]] ; then mkdir "$tmp"; fi
tar -c --exclude .git --exclude README . | tar -x -C "$tmp"
cp -vr --remove-destination "$tmp/"* "$dest/"

echo -e "Cleanup tmp directory\n"
rm --recursive -f  "$tmp"
echo -e "\n\n"
echo -e "Do you want to cleanup $cPWD content (y/n) "
read repocleanup
if [[ $repocleanup == "y" ]];then
   rm --recursive -f "$cPWD/*"
   echo -e "$cPWD contents removes\n\n"
fi

echo -e "Done."
