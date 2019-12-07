# Laravel installation in Ubuntu
## Follow Steps
1. install composer <a href ="https://github.com/AIRONAXSolutions/Dev-journal/blob/ubuntu/lampp-composer.md" target="_blank"> READ HERE </a>

  <b> with Laravel installer package </b>

2. $``composer global require laravel/installer``
3. $``echo 'export PATH="$HOME/.composer/vendor/bin:$PATH"' >> ~/.bashrc``
4. $ ``source ~/.bashrc``
5. $ ``laravel new new-site-name``

  <b> without Laravel installer package </b>
  
2. $ ``composer create-project --prefer-dist laravel/laravel new-site-name``
