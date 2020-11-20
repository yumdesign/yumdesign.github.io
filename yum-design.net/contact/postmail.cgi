#!/usr/local/bin/perl

#��������������������������������������������������������������������
#�� POST-MAIL : postmail.cgi - 2017/03/05
#�� copyright (c) KentWeb, 1997-2017
#�� http://www.kent-web.com/
#��������������������������������������������������������������������

# ���W���[�����s
use strict;
use CGI::Carp qw(fatalsToBrowser);
use MIME::Base64;
use lib './lib';
use CGI::Minimal;

# �ݒ�t�@�C���F��
require './init.cgi';
my %cf = set_init();

# �f�[�^��
CGI::Minimal::max_read_size($cf{maxdata});
my $cgi = CGI::Minimal->new;
error('�e�ʃI�[�o�[') if ($cgi->truncated);
my ($key,$need,$in) = parse_form();

# �֎~���[�h�`�F�b�N
if ($cf{no_wd}) { check_word(); }

# �z�X�g�擾���`�F�b�N
my ($host,$addr) = get_host();

# �K�{���̓`�F�b�N
my ($check,@err);
if ($$in{need} || @$need > 0) {
	# need�t�B�[���h�̒l��K�{�z��ɉ�����
	my @tmp = split(/\s+/,$$in{need});
	push(@$need,@tmp);
	
	# �K�{�z��̏d���v�f��r��
	my %count;
	@$need = grep {!$count{$_}++} @$need;
	
	# �K�{���ڂ̓��͒l���`�F�b�N����
	foreach (@$need) {
		
		# �t�B�[���h�̒l���������Ă��Ȃ����́i���W�I�{�^�����j
		if (!defined($$in{$_})) {
			$check++;
			push(@$key,$_);
			push(@err,$_);
		
		# ���͂Ȃ��̏ꍇ
		} elsif ($$in{$_} eq "") {
			$check++;
			push(@err,$_);
		}
	}
}

# ���͓��e�}�b�`
my ($match1,$match2);
if ($$in{match}) {
	($match1,$match2) = split(/\s+/,$$in{match},2);
	
	if ($$in{$match1} ne $$in{$match2}) {
		error("$match1��$match2�̍ē��͓��e���قȂ�܂�");
	}
}

# ���̓`�F�b�N�m�F���
if ($check) { err_input($match2); }

# --- �v���r���[
if ($$in{mode} ne "send") {
	# �A�����M�`�F�b�N
	check_post('view');
	
	# �m�F���
	prev_form();

# --- ���M���s
} else {
	# sendmail���M
	send_mail();
}

#-----------------------------------------------------------
#  �v���r���[
#-----------------------------------------------------------
sub prev_form {
	# ���M���e�`�F�b�N
	error("�f�[�^���擾�ł��܂���") if (@$key == 0);
	
	# ���[�������`�F�b�N
	check_email($$in{email}) if ($$in{email});
	
	# �����R�[�h�����ϊ�
	conv_code() if ($cf{conv_code} == 1);
	
	# ���Ԏ擾
	my $time = time;
	
	# �Z�b�V��������
	my $ses = make_ses($time);
	
	# ����
	if ($$in{sort}) {
		my (@tmp,%tmp);
		for ( split(/\s+/,$$in{sort}) ) {
			push(@tmp,$_);
			$tmp{$_}++;
		}
		for (@$key) {
			if (!defined($tmp{$_})) { push(@tmp,$_); }
		}
		@$key = @tmp;
	}
	
	# �A��
	my %join;
	if ($$in{join}) {
		my ($key,$val) = split(/:/,$$in{join},2);
		my $tmp;
		for ( split(/\s+/,$val) ) {
			$tmp .= $$in{$_} . $_ ;
			$join{$_}++;
		}
		$$in{$key} = $tmp;
	}
	
	# �e���v���[�g�Ǎ�
	open(IN,"$cf{tmpldir}/conf.html") or error("open err: conf.html");
	my $tmpl = join('', <IN>);
	close(IN);
	
	# �u������
	$tmpl =~ s/!mail_cgi!/$cf{mail_cgi}/g;
	
	# �e���v���[�g����
	my ($head,$loop,$foot) = $tmpl =~ /(.+)<!-- cell_begin -->(.+)<!-- cell_end -->(.+)/s
			? ($1,$2,$3)
			: error("�e���v���[�g�s��");
	
	# ����
	my $hidden;
	$hidden .= qq|<input type="hidden" name="mode" value="send">\n|;
	$hidden .= qq|<input type="hidden" name="ses_id" value="$ses">\n|;
	$hidden .= qq|<input type="hidden" name="sort" value="$$in{sort}">\n|;
	
	# ����
	my ($bef,$item,$jflg);
	foreach my $key (@$key) {
		next if ($bef eq $key);
		next if ($key eq "x");
		next if ($key eq "y");
		next if ($key eq "need");
		next if ($key eq "match");
		next if ($key eq "sort");
		next if ($key eq "join");
		next if ($$in{match} && $key eq $match2);
		if ($key eq 'subject') {
			$hidden .= qq|<input type="hidden" name="$key" value="$$in{subject}">\n|;
			next;
		}
		next if ($jflg && defined($join{$key}));
		if ($$in{join} && defined($join{$key})) {
			$jflg++;
			($key) = (split(/:/,$$in{join}))[0];
		}
		
		# name�l�`�F�b�N
		check_key($key) if ($cf{check_key});
		my $val = hex_encode($$in{$key});
		$hidden .= qq|<input type="hidden" name="$key" value="$val">\n|;
		
		# ���s�ϊ�
		$$in{$key} =~ s|\t|<br>|g;
		
		my $tmp = $loop;
		if (defined($cf{replace}->{$key})) {
			$tmp =~ s/!key!/$cf{replace}->{$key}/;
		} else {
			$tmp =~ s/!key!/$key/;
		}
		$tmp =~ s/!val!/$$in{$key}/;
		$item .= $tmp;
		
		$bef = $key;
	}
	for ($head,$foot) {
		s/<!-- hidden -->/$hidden/g;
	}
	
	# ��ʓW�J
	print "Content-type: text/html; charset=$cf{charset}\n\n";
	print $head,$item;
	
	# �t�b�^�\��
	footer($foot);
}

#-----------------------------------------------------------
#  ���M���s
#-----------------------------------------------------------
sub send_mail {
	# ���M���e�`�F�b�N
	error("�f�[�^���擾�ł��܂���") if (@$key == 0);
	
	# �Z�b�V�����`�F�b�N
	check_ses();
	
	# �A�����M�`�F�b�N
	check_post('send');
	
	# ���[�������`�F�b�N
	check_email($$in{email},'send') if ($$in{email});
	
	# ���Ԏ擾
	my ($date1,$date2) = get_time();
	
	# �u���E�U���
	my $agent = $ENV{HTTP_USER_AGENT};
	$agent =~ s/[<>&"'()+;]//g;
	
	# ����
	if ($$in{sort}) {
		my (@tmp,%tmp);
		for ( split(/\s+/,$$in{sort}) ) {
			push(@tmp,$_);
			$tmp{$_}++;
		}
		for (@$key) {
			if (!defined($tmp{$_})) { push(@tmp,$_); }
		}
		@$key = @tmp;
	}
	
	# �{���e���v���ǂݍ���
	open(IN,"$cf{tmpldir}/mail.txt") or error("open err: mail.txt");
	my $mail = join('', <IN>);
	close(IN);
	
	# �e���v���ϐ��ϊ�
	$mail =~ s/!date!/$date1/g;
	$mail =~ s/!agent!/$agent/g;
	$mail =~ s/!host!/$host/g;
	
	# �����ԐM����̂Ƃ�
	my $reply;
	if ($cf{auto_res}) {
		# �e���v��
		open(IN,"$cf{tmpldir}/reply.txt") or error("open err: reply.txt");
		$reply = join('', <IN>);
		close(IN);
		
		# �ϐ��ϊ�
		$reply =~ s/!date!/$date1/g;
	}
	
	# �{���L�[��W�J
	my ($bef,$mbody,$log);
	foreach (@$key) {
		# �{���Ɋ܂߂Ȃ�������r��
		next if ($_ eq "mode");
		next if ($_ eq "need");
		next if ($_ eq "match");
		next if ($_ eq "sort");
		next if ($_ eq "ses_id");
		next if ($_ eq "subject");
		next if ($$in{match} && $_ eq $match2);
		next if ($bef eq $_);
		
		# hex�f�R�[�h
		$$in{$_} = hex_decode($$in{$_});
		
		# name�l�̖��O�u��
		my $key_name = defined($cf{replace}->{$_}) ? $cf{replace}->{$_} : $_;
		
		# �G�X�P�[�v
		$$in{$_} =~ s/\.\n/\. \n/g;
		
		# �Y�t�t�@�C�����̕����񋑔�
		$$in{$_} =~ s/Content-Disposition:\s*attachment;.*//ig;
		$$in{$_} =~ s/Content-Transfer-Encoding:.*//ig;
		$$in{$_} =~ s/Content-Type:\s*multipart\/mixed;\s*boundary=.*//ig;
		
		# ���s����
		$$in{$_} =~ s/\t/\n/g;
		
		# HTML�^�O����
		$$in{$_} =~ s/&lt;/</g;
		$$in{$_} =~ s/&gt;/>/g;
		$$in{$_} =~ s/&quot;/"/g;
		$$in{$_} =~ s/&#39;/'/g;
		$$in{$_} =~ s/&amp;/&/g;
		
		# �{�����e
		my $tmp;
		if ($$in{$_} =~ /\n/) {
			$tmp = "$key_name = \n$$in{$_}\n";
		} else {
			$tmp = "$key_name = $$in{$_}\n";
		}
		$mbody .= $tmp;
		
		$bef = $_;
	}
	
	# �{���e���v�����̕ϐ���u������
	$mail =~ s/!message!/$mbody/;
	
	# �ԐM�e���v�����̕ϐ���u������
	$reply =~ s/!message!/$mbody/ if ($cf{auto_res});
	
	# �R�[�h�ϊ�
	$mail  = $cf{send_b64} == 1 ? conv_b64($mail)  : conv_jis($mail);
	$reply = $cf{send_b64} == 1 ? conv_b64($reply) : conv_jis($reply) if ($cf{auto_res});
	
	# ���[���A�h���X���Ȃ��ꍇ�͑��M��ɒu������
	my $email = $$in{email} eq '' ? $cf{mailto} : $$in{email};
	
	# MIME�G���R�[�h
	my $sub_me = $$in{subject} ne '' && defined($cf{multi_sub}->{$$in{subject}}) ? $cf{multi_sub}->{$$in{subject}} : $cf{subject};
	$sub_me = mime_unstructured_header($sub_me);
	my $from;
	if ($$in{name}) {
		$$in{name} =~ s/[\r\n]//g;
		$from = mime_unstructured_header("\"$$in{name}\" <$email>");
	} else {
		$from = $email;
	}
	
	# --- ���M���e�t�H�[�}�b�g�J�n
	# �w�b�_�[
	my $body;
	$body .= "To: $cf{mailto}\n";
	$body .= "From: $from\n";
	$body .= "Subject: $sub_me\n";
	$body .= "MIME-Version: 1.0\n";
	$body .= "Date: $date2\n";
	
	if ($cf{send_b64} == 1) {
		$body .= "Content-type: text/plain; charset=$cf{charset}\n";
		$body .= "Content-Transfer-Encoding: base64\n";
	} else {
		$body .= "Content-type: text/plain; charset=iso-2022-jp\n";
		$body .= "Content-Transfer-Encoding: 7bit\n";
	}
	
	$body .= "X-Mailer: $cf{version}\n\n";
	$body .= "$mail\n";
	
	# �ԐM���e�t�H�[�}�b�g
	my $res_body;
	if ($cf{auto_res}) {
		
		# ����MIME�G���R�[�h
		my $re_sub = mime_unstructured_header($cf{sub_reply});
		
		$res_body .= "To: $email\n";
		$res_body .= "From: $cf{mailto}\n";
		$res_body .= "Subject: $re_sub\n";
		$res_body .= "MIME-Version: 1.0\n";
		$res_body .= "Date: $date2\n";
		
		if ($cf{send_b64} == 1) {
			$res_body .= "Content-type: text/plain; charset=$cf{charset}\n";
			$res_body .= "Content-Transfer-Encoding: base64\n";
		} else {
			$res_body .= "Content-type: text/plain; charset=iso-2022-jp\n";
			$res_body .= "Content-Transfer-Encoding: 7bit\n";
		}
		
		$res_body .= "X-Mailer: $cf{version}\n\n";
		$res_body .= "$reply\n";
	}
	
	# senmdail�R�}���h
	my $scmd = $cf{send_fcmd} ? "$cf{sendmail} -t -i -f $email" : "$cf{sendmail} -t -i";
	
	# �{�����M
	open(MAIL,"| $scmd") or error("���[�����M���s");
	print MAIL "$body\n";
	close(MAIL);
	
	# �ԐM���M
	if ($cf{auto_res}) {
		my $scmd = $cf{send_fcmd} ? "$cf{sendmail} -t -i -f $cf{mailto}" : "$cf{sendmail} -t -i";
		
		open(MAIL,"| $scmd") or error("���[�����M���s");
		print MAIL "$res_body\n";
		close(MAIL);
	}
	
	# �����[�h
	if ($cf{reload}) {
		if ($ENV{PERLXS} eq "PerlIS") {
			print "HTTP/1.0 302 Temporary Redirection\r\n";
			print "Content-type: text/html\n";
		}
		print "Location: $cf{back}\n\n";
		exit;
	
	# �������b�Z�[�W
	} else {
		open(IN,"$cf{tmpldir}/thanks.html") or error("open err: thanks.html");
		my $tmpl = join('', <IN>);
		close(IN);
		
		# �\��
		print "Content-type: text/html; charset=$cf{charset}\n\n";
		$tmpl =~ s/!back!/$cf{back}/g;
		footer($tmpl);
	}
}

#-----------------------------------------------------------
#  ���̓G���[�\��
#-----------------------------------------------------------
sub err_input {
	my $match2 = shift;
	
	# ����
	if ($$in{sort}) {
		my (@tmp,%tmp);
		for ( split(/\s+/,$$in{sort}) ) {
			push(@tmp,$_);
			$tmp{$_}++;
		}
		for (@$key) {
			if (!defined($tmp{$_})) { push(@tmp,$_); }
		}
		@$key = @tmp;
	}
	
	# �e���v���[�g�ǂݍ���
	open(IN,"$cf{tmpldir}/error.html") or die;
	my $tmpl = join('', <IN>);
	close(IN);
	
	# �e���v���[�g����
	my ($head,$loop,$foot) = $tmpl =~ /(.+)<!-- cell_begin -->(.+)<!-- cell_end -->(.+)/s
			? ($1,$2,$3)
			: error("�e���v���[�g�s��");
	
	# �w�b�_
	print "Content-type: text/html; charset=$cf{charset}\n\n";
	print $head;
	
	# ���e�W�J
	my $bef;
	foreach my $key (@$key) {
		next if ($key eq "need");
		next if ($key eq "match");
		next if ($key eq "sort");
		next if ($$in{match} && $key eq $match2);
		next if ($bef eq $key);
		next if ($key eq "x");
		next if ($key eq "y");
		next if ($key eq "subject");
		
		my $key_name = defined($cf{replace}->{$key}) ? $cf{replace}->{$key} : $key;
		my $tmp = $loop;
		$tmp =~ s/!key!/$key_name/;
		
		my $erflg;
		foreach my $err (@err) {
			if ($err eq $key) {
				$erflg++;
				last;
			}
		}
		# ���͂Ȃ�
		if ($erflg) {
			$tmp =~ s/!val!/<span class="msg">$key_name�͓��͕K�{�ł�.<\/span>/;
		
		# ����
		} else {
			$$in{$key} =~ s/\t/<br>/g;
			$tmp =~ s/!val!/$$in{$key}/;
		}
		print $tmp;
		
		$bef = $key;
	}
	
	# �t�b�^
	print $foot;
	exit;
}

#-----------------------------------------------------------
#  �t�H�[���f�R�[�h
#-----------------------------------------------------------
sub parse_form {
	my (@key,@need,%in);
	foreach my $key ( $cgi->param() ) {
		
		# �����l�̏ꍇ�̓X�y�[�X�ŋ�؂�
		my $val = join(" ", $cgi->param($key));
		
		# ���Q��/���s�ϊ�
		$key =~ s/[<>&"'\r\n]//g;
		$val =~ s/&/&amp;/g;
		$val =~ s/</&lt;/g;
		$val =~ s/>/&gt;/g;
		$val =~ s/"/&quot;/g;
		$val =~ s/'/&#39;/g;
		$val =~ s/\r\n/\t/g;
		$val =~ s/\r/\t/g;
		$val =~ s/\n/\t/g;
		
		# ���͕K�{
		if ($key =~ /^_(.+)/) {
			$key = $1;
			push(@need,$key);
		}
		
		# �󂯎��L�[�̏��Ԃ��o���Ă���
		push(@key,$key);
		
		# %in�n�b�V���ɑ��
		$in{$key} = $val;
	}
	
	# post���M�`�F�b�N
	if ($cf{postonly} && $ENV{REQUEST_METHOD} ne 'POST') {
		error("�s���ȃA�N�Z�X�ł�");
	}
	
	# ���t�@�����X�ŕԂ�
	return (\@key,\@need,\%in);
}

#-----------------------------------------------------------
#  �t�b�^�[
#-----------------------------------------------------------
sub footer {
	my $foot = shift;
	
	# ���쌠�\�L�i�폜�E���ϋ֎~�j
	my $copy = <<EOM;
<p style="margin-top:2em;text-align:center;font-family:Verdana,Helvetica,Arial;font-size:10px;">
	- <a href="http://www.kent-web.com/" target="_top">POST MAIL</a> -
</p>
EOM

	if ($foot =~ /(.+)(<\/body[^>]*>.*)/si) {
		print "$1$copy$2\n";
	} else {
		print "$foot$copy\n";
		print "</body></html>\n";
	}
	exit;
}

#-----------------------------------------------------------
#  �G���[����
#-----------------------------------------------------------
sub error {
	my $err = shift;
	
	open(IN,"$cf{tmpldir}/error.html") or die;
	my $tmpl = join('', <IN>);
	close(IN);
	
	# �����u������
	$tmpl =~ s/!key!/�G���[���e/g;
	$tmpl =~ s|!val!|<span class="msg">$err</span>|g;
	
	print "Content-type: text/html; charset=$cf{charset}\n\n";
	print $tmpl;
	exit;
}

#-----------------------------------------------------------
#  ���Ԏ擾
#-----------------------------------------------------------
sub get_time {
	$ENV{TZ} = "JST-9";
	my ($sec,$min,$hour,$mday,$mon,$year,$wday) = localtime(time);
	my @week  = qw|Sun Mon Tue Wed Thu Fri Sat|;
	my @month = qw|Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec|;
	
	# �����̃t�H�[�}�b�g
	my $date1 = sprintf("%04d/%02d/%02d(%s) %02d:%02d:%02d",
			$year+1900,$mon+1,$mday,$week[$wday],$hour,$min,$sec);
	my $date2 = sprintf("%s, %02d %s %04d %02d:%02d:%02d",
			$week[$wday],$mday,$month[$mon],$year+1900,$hour,$min,$sec) . " +0900";
	
	return ($date1,$date2);
}

#-----------------------------------------------------------
#  �z�X�g���擾
#-----------------------------------------------------------
sub get_host {
	# �z�X�g���擾
	my $host = $ENV{REMOTE_HOST};
	my $addr = $ENV{REMOTE_ADDR};
	
	if ($cf{gethostbyaddr} && ($host eq "" || $host eq $addr)) {
		$host = gethostbyaddr(pack("C4", split(/\./, $addr)), 2);
	}
	$host ||= $addr;
	
	# �`�F�b�N
	if ($cf{denyhost}) {
		my $flg;
		foreach ( split(/\s+/, $cf{denyhost}) ) {
			s/\./\\\./g;
			s/\*/\.\*/g;
			
			if ($host =~ /$_/i) { $flg++; last; }
		}
		if ($flg) { error("�A�N�Z�X��������Ă��܂���"); }
	}
	
	return ($host,$addr);
}

#-----------------------------------------------------------
#  ���M�`�F�b�N
#-----------------------------------------------------------
sub check_post {
	my $job = shift;
	
	# ���Ԏ擾
	my $now = time;
	
	# ���O�I�[�v��
	open(DAT,"+< $cf{logfile}") or error("open err: $cf{logfile}");
	eval "flock(DAT, 2);";
	my $data = <DAT>;
	
	# ����
	my ($ip,$time) = split(/<>/,$data);
	
	# IP�y�ю��Ԃ��`�F�b�N
	if ($ip eq $addr && $now - $time <= $cf{block_post}) {
		close(DAT);
		error("�A�����M��$cf{block_post}�b�Ԃ��҂���������");
	}
	
	# ���M���͕ۑ�
	if ($job eq "send") {
		seek(DAT, 0, 0);
		print DAT "$addr<>$now";
		truncate(DAT, tell(DAT));
	}
	close(DAT);
}

#-----------------------------------------------------------
#  �Z�b�V��������
#-----------------------------------------------------------
sub make_ses {
	my $now = shift;
	
	# �Z�b�V�������s
	my @wd = (0 .. 9, 'a' .. 'z', 'A' .. 'Z', '_');
	my $ses;
	srand;
	for (1 .. 25) {	$ses .= $wd[int(rand(@wd))]; }
	
	# �Z�b�V���������Z�b�g
	my @log;
	open(DAT,"+< $cf{sesfile}") or error("open err: $cf{sesfile}");
	eval 'flock(DAT, 2);';
	while(<DAT>) {
		chomp;
		my ($id,$time) = split(/\t/);
		next if ($now - $time > $cf{sestime} * 60);
		
		push(@log,"$_\n");
	}
	unshift(@log,"$ses\t$now\n");
	seek(DAT, 0, 0);
	print DAT @log;
	truncate(DAT, tell(DAT));
	close(DAT);
	
	return $ses;
}

#-----------------------------------------------------------
#  �Z�b�V�����`�F�b�N
#-----------------------------------------------------------
sub check_ses {
	# �������`�F�b�N
	if ($$in{ses_id} !~ /^\w{25}$/) { error('�s���ȃA�N�Z�X�ł�'); }
	
	my $now = time;
	my $flg;
	open(DAT,"$cf{sesfile}") or error("open err: $cf{sesfile}");
	while(<DAT>) {
		chomp;
		my ($id,$time) = split(/\t/);
		next if ($now - $time > $cf{sestime} * 60);
		
		if ($id eq $$in{ses_id}) {
			$flg++;
			last;
		}
	}
	close(DAT);
	
	# �G���[�̂Ƃ�
	if (!$flg) {
		error('�m�F��ʕ\�����莞�Ԃ��o�߂��܂����B�ŏ������蒼���Ă�������');
	}
}

#-----------------------------------------------------------
#  hex�G���R�[�h
#-----------------------------------------------------------
sub hex_encode {
	my $str = shift;
	
	$str =~ s/(.)/unpack('H2', $1)/eg;
	$str =~ s/\n/\t/g;
	return $str;
}

#-----------------------------------------------------------
#  hex�f�R�[�h
#-----------------------------------------------------------
sub hex_decode {
	my $str = shift;
	
	$str =~ s/\t/\n/g;
	$str =~ s/([0-9A-Fa-f]{2})/pack('H2', $1)/eg;
	return $str;
}

#-----------------------------------------------------------
#  �d�q���[�������`�F�b�N
#-----------------------------------------------------------
sub check_email {
	my ($eml,$job) = @_;
	
	# ���M����hex�f�R�[�h
	if ($job eq 'send') { $eml = hex_decode($eml); }
	
	# E-mail�����`�F�b�N
	if ($eml =~ /\,/) {
		error("���[���A�h���X�ɃR���} ( , ) ���܂܂�Ă��܂�");
	}
	if ($eml ne '' && $eml !~ /^[\w\.\-]+\@[\w\.\-]+\.[a-zA-Z]{2,6}$/) {
		error("���[���A�h���X�̏������s���ł�");
	}
}

#-----------------------------------------------------------
#  name�l�`�F�b�N
#-----------------------------------------------------------
sub check_key {
	my $key = shift;
	
	my $char = $cf{kcode} eq 'utf8'
		? '[\xE0-\xEF][\x80-\xBF]{2}'
		: '[\x81-\x9F\xE0-\xFC][\x40-\x7E\x80-\xFC]';
	
	if ($key !~ /^(?:[0-9a-zA-Z_-]|$char)+$/) {
		error("name�l�ɕs���ȕ������܂܂�Ă��܂�");
	}
}

#-----------------------------------------------------------
#  �֎~���[�h�`�F�b�N
#-----------------------------------------------------------
sub check_word {
	my $flg;
	foreach (@$key) {
		foreach my $wd ( split(/,/,$cf{no_wd}) ) {
			if (index($$in{$_},$wd) >= 0) {
				$flg++;
				last;
			}
		}
		if ($flg) { error("�֎~���[�h���܂܂�Ă��܂�"); }
	}
}

#-----------------------------------------------------------
#  �����R�[�h�ϊ� to jis
#-----------------------------------------------------------
sub conv_jis {
	my ($str,$kcode) = @_;
	$kcode ||= $cf{kcode};
	
	if ($cf{conv_pm} eq 'j') {
		jcode::convert(\$str,'jis',$kcode);
	} else {
		$str = Unicode::Japanese->new($str,$kcode)->jis;
	}
	return $str;
}

#-----------------------------------------------------------
#  �����R�[�h�ϊ� to euc
#-----------------------------------------------------------
sub conv_euc {
	my $str = shift;
	
	if ($cf{conv_pm} eq 'j') {
		jcode::convert(\$str,'euc',$cf{kcode})
	} else {
		$str = Unicode::Japanese->new($str,$cf{kcode})->euc;
	}
	return $str;
}

#-----------------------------------------------------------
#  �����R�[�h�ϊ� to utf-8
#-----------------------------------------------------------
sub conv_utf8 {
	my $str = shift;
	
	if ($cf{conv_pm} eq 'j') {
		jcode::convert(\$str,'utf8','euc')
	} else {
		$str = Unicode::Japanese->new($str,'euc')->utf8;
	}
	return $str;
}

#-----------------------------------------------------------
#  mime�G���R�[�h
#  [quote] http://www.din.or.jp/~ohzaki/perl.htm#JP_Base64
#-----------------------------------------------------------
sub mime_unstructured_header {
  my $oldheader = shift;
  $oldheader = conv_euc($oldheader);
  my ($header,@words,@wordstmp,$i);
  my $crlf = $oldheader =~ /\n$/;
  $oldheader =~ s/\s+$//;
  @wordstmp = split /\s+/, $oldheader;
  for ($i = 0; $i < $#wordstmp; $i++) {
    if ($wordstmp[$i] !~ /^[\x21-\x7E]+$/ and
	$wordstmp[$i + 1] !~ /^[\x21-\x7E]+$/) {
      $wordstmp[$i + 1] = "$wordstmp[$i] $wordstmp[$i + 1]";
    } else {
      push(@words, $wordstmp[$i]);
    }
  }
  push(@words, $wordstmp[-1]);
  foreach my $word (@words) {
    if ($word =~ /^[\x21-\x7E]+$/) {
      $header =~ /(?:.*\n)*(.*)/;
      if (length($1) + length($word) > 76) {
	$header .= "\n $word";
      } else {
	$header .= $word;
      }
    } else {
      $header = add_encoded_word($word, $header);
    }
    $header =~ /(?:.*\n)*(.*)/;
    if (length($1) == 76) {
      $header .= "\n ";
    } else {
      $header .= ' ';
    }
  }
  $header =~ s/\n? $//mg;
  $crlf ? "$header\n" : $header;
}
sub add_encoded_word {
  my($str,$line) = @_;

  my ($mtop,$uflg);
  if ($cf{kcode} eq 'utf8' && $cf{send_b64} == 1) {
  	$mtop = '=?UTF-8?B?';
  	$uflg++;
  } else {
  	$mtop = '=?ISO-2022-JP?B?';
  }

  my $result;
  my $ascii = '[\x00-\x7F]';
  my $twoBytes = '[\x8E\xA1-\xFE][\xA1-\xFE]';
  my $threeBytes = '\x8F[\xA1-\xFE][\xA1-\xFE]';

  while (length($str)) {
    my $target = $str;
    $str = '';
    if (length($line) + 22 +
	($target =~ /^(?:$twoBytes|$threeBytes)/o) * 8 > 76) {
      $line =~ s/[ \t\n\r]*$/\n/;
      $result .= $line;
      $line = ' ';
    }
    while (1) {
      $target = $uflg ? conv_utf8($target) : conv_jis($target,'euc');
      my $encoded = $mtop . encode_base64($target, '') . '?=';
      if (length($encoded) + length($line) > 76) {
	$target =~ s/($threeBytes|$twoBytes|$ascii)$//o;
	$str = $1 . $str;
      } else {
	$line .= $encoded;
	last;
      }
    }
  }
  $result . $line;
}

#-----------------------------------------------------------
#  Base64�G���R�[�h
#-----------------------------------------------------------
sub conv_b64 {
	my $str = shift;
	
	$str =~ s/\n/\r\n/g;
	return encode_base64($str);
}

#-----------------------------------------------------------
#  �����R�[�h�����ϊ�
#-----------------------------------------------------------
sub conv_code {
	my (@tmp,%tmp);
	for my $key (@$key) {
		my $val = $$in{$key};
		
		if ($cf{conv_pm} eq 'j') {
			jcode::convert(\$key,$cf{kcode});
			jcode::convert(\$val,$cf{kcode});
		} else {
			$key = Unicode::Japanese->new($key,'auto')->conv($cf{kcode});
			$val = Unicode::Japanese->new($val,'auto')->conv($cf{kcode});
		}
		push(@tmp,$key);
		$tmp{$key} = $val;
	}
	$key = \@tmp;
	$in  = \%tmp;
}

