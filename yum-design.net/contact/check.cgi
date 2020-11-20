#!/usr/local/bin/perl

#��������������������������������������������������������������������
#�� POST-MAIL : check.cgi - 2017/10/11
#�� copyright (c) KentWeb, 1997-2017
#�� http://www.kent-web.com/
#��������������������������������������������������������������������

# ���W���[���錾
use strict;
use CGI::Carp qw(fatalsToBrowser);
use lib "./lib";

# �O���t�@�C����荞��
require './init.cgi';
my %cf = set_init();

print <<EOM;
Content-type: text/html; charset=$cf{charset}

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=$cf{charset}">
<title>Check Mode</title>
</head>
<body>
<b>Check Mode: [ $cf{version} ]</b>
<ul>
<li>Perl�o�[�W���� : $]
EOM

# ���O�t�@�C��
my %log = (logfile => '���O�t�@�C��', sesfile => '�Z�b�V�����t�@�C��');
for ( keys %log ) {
	if (-f $cf{$_}) {
		print "<li>$log{$_}�p�X : OK\n";

		if (-r $cf{$_} && -w $cf{$_}) {
			print "<li>$log{$_}�p�[�~�b�V���� : OK\n";
		} else {
			print "<li>$log{$_}�p�[�~�b�V���� : NG\n";
		}
	} else {
		print "<li>$log{$_}�p�X : NG\n";
	}
}

# sendmail�`�F�b�N
print "<li>sendmail�p�X : ";
if (-e $cf{sendmail}) {
	print "OK\n";
} else {
	print "NG\n";
}

# �e���v���[�g
for (qw(conf.html error.html thanks.html mail.txt reply.txt)) {
	print "<li>�e���v���[�g ( $_ ) : ";

	if (-f "$cf{tmpldir}/$_") {
		print "�p�XOK\n";
	} else {
		print "�p�XNG\n";
	}
}

# for UTF-8
if ($cf{kcode} eq 'utf8') {
	my @bom = (
		chr(0x00).chr(0x00).chr(0xFE).chr(0xFF),
		chr(0xFF).chr(0xFE).chr(0x00).chr(0x00),
		chr(0x00).chr(0x00).chr(0xFF).chr(0xFE),
		chr(0xFE).chr(0xFF).chr(0x00).chr(0x00),
		chr(0xFE).chr(0xFF),
		chr(0xFF).chr(0xFE),
		chr(0xEF).chr(0xBB).chr(0xBF)
	);

	# BOM�`�F�b�N
	for (qw(mail.txt reply.txt)) {
		open(IN,"$cf{tmpldir}/$_");
		my $data = <IN>;
		close(IN);

		my $flg;
		for ( my $i = 0; $i <= $#bom; $i++ ) {
			if (index($data,$bom[$i]) == 0) {
				$flg++;
				last;
			}
		}
		if ($flg) {
			print "<li>�{�� ( $_ ) BOM���� : NG\n";
		} else {
			print "<li>�{�� ( $_ ) BOM�Ȃ� : OK\n";
		}
	}
}

print <<EOM;
</ul>
</body>
</html>
EOM
exit;

