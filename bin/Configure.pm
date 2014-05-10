#
# Copyright 2008 PookMail.com (tm).
#
# Licensed under the GNU GENERAL PUBLIC LICENSE, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.

package Configure;
use strict;
use vars qw {$CFG};

$CFG = {
  domain => "pookmail.example.com",
  smtp => {
    ip => "0.0.0.0",
    port => 25
  },
  timeout => 45,
  log_dir => "/path/to/pookmail/log/",
  db => {
    connstr => "mysql:database=gatika;mysql_connect_timeout=3;host=192.168.0.1",
    user    => "pookmail",
    pass    => "123456"
  },
  expire => 86400
};
