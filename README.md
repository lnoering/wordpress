<h1 align="center">lnoering/wordpress</h1>

<div align="center">
  <p>Leonardo Noering - To improve the knowledge</p>
  <img src="https://img.shields.io/badge/knowlege-improve%20the%20knowledge-green" alt="Improve the knowledge" />
</div>

> Using this repo to improve the knowledge


## Table of contents

- [Install](#install)
- [Server](#server)
- [Git](#git)
  - [Server Deploy Configs](#server-deploy-configs)
  - [Server Push Tag to Repository](#server-push-tag-to-repository)
  - [Local Configs to Deploy](#local-Configs-to-deploy)
  - [Deploy Command](#deploy-command)
  - [Flow to work](#git-flow)
- [Frontend](#frontned)
- [Debug](#debug)
- [CI](#ci)

## Install


## Server

## Git

- Install
```bash
sudo yum install git
```

- Config
```bash
git config --global user.name "Deployer"
git config --global user.email "lnoering@gmail.com"
```

### Server Deploy Configs

- Run this commands at the server
```bash
mkdir /home/web/app/code
mkdir /home/web/app/code/wordpress.git
cd /home/web/app/code/wordpress.git
git init --bare
```

- Set the post-receive hook to git
```bash
mkdir /home/web/app/code/checkout
cd /home/web/app/code/wordpress.git/hooks
touch post-receive
chmod +x post-receive
vim post-receive
```

- Copy the data of post-receive from .configs/git bare/post-receive

### Server Push Tag to Repository

- Create one ssh-key at server (user web)
```bash
  ssh-keygen -t ed25519 -C "your_email@example.com"
```

- Add the key to the agent ssh. (not the .pub)
```bash
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/<key-created>
```

- Copy the pub key
```bash
cat ~/.ssh/<key-created>.pub
```

- Add to the github deploy key. (Enable the write)
  - https://github.com/\<repo-user\>/\<remo-name\>/settings/keys
  
    In my case:

  - https://github.com/lnoering/wordpress/settings/keys

### Local Configs to Deploy

- Creating one remote at your machine to deploy.
```bash
git remote add deploy ssh://web@dropletserver:22/home/app/code/wordpress.git
```

### Deploy Command

- The command to deploy. (we will use the master to deploy)
```bash
git push deploy master
```

### Git Flow

- Proccess to work with branchs 
  - [Branching-model](https://nvie.com/posts/a-successful-git-branching-model/)
  - [Git flow)](https://blog.betrybe.com/git/git-flow/)


## Frontend

To do

## Debug

To do

## CI

To do



*using the docker from - xxx