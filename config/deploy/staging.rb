set :stage, :staging

set :deploy_to, "/home/crepan/www"
set :tmp_dir, "/home/crepan/tmp"

set :password, ask('Server password:', nil)

# Simple Role Syntax
# ==================
#role :app, %w{deploy@example.com}
#role :web, %w{deploy@example.com}
#role :db,  %w{deploy@example.com}

# Extended Server Syntax
# ======================
server 'ssh.alwaysdata.com', user: 'crepan', roles: %w{web app db}, password: fetch(:password)

# you can set custom ssh options
# it's possible to pass any option but you need to keep in mind that net/ssh understand limited list of options
# you can see them in [net/ssh documentation](http://net-ssh.github.io/net-ssh/classes/Net/SSH.html#method-c-start)
# set it globally
# set :ssh_options, {
#   forward_agent: false,
#   auth_methods: %w(password)
# }

SSHKit.config.command_map[:composer] = "php /home/crepan/bin/composer.phar"

fetch(:default_env).merge!(wp_env: :staging)

