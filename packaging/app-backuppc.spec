
Name: app-backuppc
Epoch: 1
Version: 1.0.3
Release: 1%{dist}
Summary: BackupPC
License: GPLv3
Group: ClearOS/Apps
Packager: Tim Burgess
Vendor: Tim Burgess
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base

%description
BackupPC is a high-performance, enterprise-grade system for backing up Linux and WinXX PCs and laptops to a server's disk. BackupPC is highly configurable and easy to install and maintain. It supports backup via SMB using Samba, tar over SSH/RSH/NFS or Rsync. It is robust, reliable and well documented Open Source backup software.

%package core
Summary: BackupPC - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: BackupPC >= 3.2

%description core
BackupPC is a high-performance, enterprise-grade system for backing up Linux and WinXX PCs and laptops to a server's disk. BackupPC is highly configurable and easy to install and maintain. It supports backup via SMB using Samba, tar over SSH/RSH/NFS or Rsync. It is robust, reliable and well documented Open Source backup software.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/backuppc
cp -r * %{buildroot}/usr/clearos/apps/backuppc/

install -D -m 0644 packaging/BackupPC.conf %{buildroot}/usr/clearos/sandbox/etc/httpd/conf.d/BackupPC.conf
install -D -m 0644 packaging/backuppc.php %{buildroot}/var/clearos/base/daemon/backuppc.php

if [ -d %{buildroot}/usr/clearos/apps/backuppc/libraries_zendguard ]; then
    rm -rf %{buildroot}/usr/clearos/apps/backuppc/libraries
    mv %{buildroot}/usr/clearos/apps/backuppc/libraries_zendguard %{buildroot}/usr/clearos/apps/backuppc/libraries
fi

%post
logger -p local6.notice -t installer 'app-backuppc - installing'

%post core
logger -p local6.notice -t installer 'app-backuppc-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/backuppc/deploy/install ] && /usr/clearos/apps/backuppc/deploy/install
fi

[ -x /usr/clearos/apps/backuppc/deploy/upgrade ] && /usr/clearos/apps/backuppc/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-backuppc - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-backuppc-core - uninstalling'
    [ -x /usr/clearos/apps/backuppc/deploy/uninstall ] && /usr/clearos/apps/backuppc/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/backuppc/controllers
/usr/clearos/apps/backuppc/htdocs
/usr/clearos/apps/backuppc/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/backuppc/packaging
%exclude /usr/clearos/apps/backuppc/tests
%dir /usr/clearos/apps/backuppc
/usr/clearos/apps/backuppc/deploy
/usr/clearos/apps/backuppc/language
/usr/clearos/apps/backuppc/libraries
%config(noreplace) /usr/clearos/sandbox/etc/httpd/conf.d/BackupPC.conf
/var/clearos/base/daemon/backuppc.php
