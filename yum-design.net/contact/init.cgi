# ���W���[���錾/�ϐ�������
use strict;
my %cf;
#��������������������������������������������������������������������
#�� POST-MAIL : postmail.cgi - 2017/10/11
#�� copyright (c) KentWeb, 1997-2017
#�� http://www.kent-web.com/
#��������������������������������������������������������������������
$cf{version} = 'postmail v9.01';
#��������������������������������������������������������������������
#�� [���ӎ���]
#�� 1. ���̃v���O�����̓t���[�\�t�g�ł��B���̃v���O�������g�p����
#��    �����Ȃ鑹�Q�ɑ΂��č�҂͈�؂̐ӔC�𕉂��܂���B
#�� 2. ���M�t�H�[����HTML�y�[�W�̍쐬�Ɋւ��ẮAHTML���@�̔��e
#��    �ƂȂ邽�߁A�T�|�[�g�ΏۊO�ƂȂ�܂��B
#�� 3. �ݒu�Ɋւ��鎿��̓T�|�[�g�f���ɂ��肢�������܂��B
#��    ���ڃ��[���ɂ�鎿��͂��󂯂������Ă���܂���B
#��������������������������������������������������������������������
#
# [ ���M�t�H�[�� (HTML) �̋L�q�� ]
#
# �E�^�O�̋L�q�� (1)
#   ���Ȃ܂� <input type="text" name="name" />
#   �� ���̃t�H�[���Ɂu�R�c���Y�v�Ɠ��͂��đ��M����ƁA
#      �uname} = �R�c���Y�v�Ƃ����`���Ŏ�M���܂�
#
# �E�^�O�̋L�q�� (2)
#   ���D���ȐF <input type="radio" name="color" value="��" />
#   �� ���̃��W�I�{�b�N�X�Ƀ`�F�b�N���đ��M����ƁA
#      �ucolor} = �v�Ƃ����`���Ŏ�M���܂�
#
# �E�^�O�̋L�q�� (3)
#   E-mail <input type="text" name="email" />
#   �� name�l�Ɂuemail�v�Ƃ����������g���Ƃ���̓��[���A�h���X
#      �ƔF�����A�A�h���X�̏������ȈՃ`�F�b�N���܂�
#   �� (��) abc@xxx.co.jp
#   �� (�~) abc.xxx.co.jp �� ���̓G���[�ƂȂ�܂�
#
# �E�^�O�̋L�q�� (4)
#   E-mail <input type="text" name="_email" />
#   �� name�l�̐擪�Ɂu�A���_�[�o�[ �v��t����ƁA���̓��͒l��
#     �u���͕K�{�v�ƂȂ�܂��B
#      ��L�̗�ł́A�u���[���A�h���X�͓��͕K�{�v�ƂȂ�܂��B
#
# �Ename�l�ւ́u�S�p�����v�̎g�p�͉\�ł�
#  (��) <input type="radio" name="�N��" value="20�Α�" />
#  �� ��L�̃��W�I�{�b�N�X�Ƀ`�F�b�N�����đ��M����ƁA
#     �u�N��} = 20�Α�v�Ƃ��������Ŏ󂯎�邱�Ƃ��ł��܂��B
#
# �Ename�l���uname�v�Ƃ���Ƃ�����u���M�Җ��v�ƔF�����đ��M����
#   ���[���A�h���X���u���M�� <���[���A�h���X>�v�Ƃ����t�H�[�}�b�g��
#   �����ϊ����܂��B
#  (�t�H�[���L�q��)  <input type="text" name="name" />
#  (���M���A�h���X)  ���Y <taro@email.xx.jp>
#
# �E����^�O-1
#   �� ���͕K�{���ڂ������w�肷��i���p�X�y�[�X�ŕ����w��j
#   �� ���W�I�{�^���A�`�F�b�N�{�b�N�X�΍�
#   �� name�l���uneed�v�Avalue�l���u�K�{����1 + ���p�X�y�[�X +�K�{����2 + ���p�X�y�[�X ...�v
#   (��) <input type="hidden" name="need" value="���O ���[���A�h���X ����" />
#
# �E����^�O-2
#   �� 2�̓��͓��e�����ꂩ���`�F�b�N����
#   �� name�l���umatch�v�Avalue�l���u����1 + ���p�X�y�[�X + ����2�v
#   (��) <input type="hidden" name="match" value="email email2" />
#
# �E����^�O-3
#   �� name�l�̕��я����w�肷��i���p�X�y�[�X�ŕ����w��j
#   �� ���̓G���[��ʋy�у��[���{���̕��т��w�肵�܂�
#   (��) <input type="hidden" name="sort" value="name email ���b�Z�[�W" />

#===========================================================
#  ����{�ݒ�
#===========================================================

# ���̃v���O�����̕����R�[�h (utf8 or sjis)
# utf8 : UTF-8
# sjis : Shift-JIS
$cf{kcode} = 'sjis';

# ���M�惁�[���A�h���X
$cf{mailto} = 'info@yum-design.net';

# sendmail�̃p�X�y�T�[�o�p�X�z
# �� �v���o�C�_�̎w����m�F�̂���
$cf{sendmail} = '/usr/sbin/sendmail';

# sendmail�ւ�-f�R�}���h�i�v���o�C�_�̎d�l�m�F�j
# 0 : no
# 1 : yes
$cf{send_fcmd} = 0;

# �����R�[�h�������ʁi0=no 1=yes�j
# �� �t�H�[������̕����R�[�h�������ʂ��s���ꍇ
# �� �ʏ�́A�u0�v�̂ق����]�܂���
$cf{conv_code} = 0;

# ���[���{����Base64�ő���
# �� �@��ˑ��������������ꍇ��AUTF-8�łŊC�O�Ƃ̑��M���ɗL���B
# 0 : no
# 1 : yes
$cf{send_b64} = 0;

# �t�H�[����name�l�̒u������������ꍇ�i�C�ӃI�v�V�����j
# �� �p����name�l����{��Ɏ����I�ɒu�������܂��B
# ��: �uemail = xx@xx.xx�v���u���[���A�h���X = xx@xx.xx�v
$cf{replace} = {
		'name'    => '�����O',
		'email'   => '���[���A�h���X',
		'comment' => '�R�����g',
	};

# ���M�҂ւ̃��[���ԐM
# 0 : no
# 1 : yes
$cf{auto_res} = 1;

# ���[�������i�����l�j
$cf{subject} = '�yYum-design�z���₢���킹�t�H�[��';

# ���[�������̊O���w��i�C�ӃI�v�V�����j
# �� �����̃t�H�[�����[���ŉ^�p����ꍇ�A�^�O�Ō����w�肷��
$cf{multi_sub} = {
		1 => '���������t�H�[��',
		2 => '�������t�H�[��',
		3 => '�����z�A���t�H�[��',
	};

# �ԐM�������[���^�C�g��
$cf{sub_reply} = '�yYum-design�z���₢���킹���肪�Ƃ��������܂�';

# �{�̃v���O�����yURL�p�X�z
$cf{mail_cgi} = './postmail.cgi';

# ���O�t�@�C���y�T�[�o�p�X�z
$cf{logfile} = './data/log.cgi';

# �Z�b�V�����t�@�C���y�T�[�o�p�X�z
$cf{sesfile} = './data/ses.cgi';

# �e���v���[�g�f�B���N�g���y�T�[�o�p�X�z
$cf{tmpldir} = './tmpl';

# �Z�b�V�����̋��e���ԁi���P�ʁj
# �� �m�F��ʕ\����A���M�{�^���������܂ł̎���
$cf{sestime} = 5;

# ���M��̌`��
# 0 : �������b�Z�[�W���o��.
# 1 : �߂�� ($back) �֎����W�����v������.
$cf{reload} = 0;

# ���M��̖߂��yURL�p�X�z
$cf{back} = '/';

# �t�H�[����name�l�̐��������`�F�b�N����i�Z�L�����e�B������j
# �� ���p�����͉p�����A�A���_�[�o�[�A�n�C�t����OK�B�S�p�͑S��OK
# 0 : no
# 1 : yes
$cf{check_key} = 0;

# ����IP�A�h���X����̘A�����M����
# �� ������Ԋu��b���Ŏw��i0�ɂ���Ƃ��̋@�\�͖����j
$cf{block_post} = 60;

# ���M�� method=POST ���� (�Z�L�����e�B�΍�)
# 0 : no
# 1 : yes
$cf{postonly} = 1;

# �ő��M�T�C�Y�iByte�j
# �� �� : 102400Bytes = 100KB
$cf{maxdata} = 102400;

# �z�X�g���擾���@
# 0 : gethostbyaddr�֐����g��Ȃ�
# 1 : gethostbyaddr�֐����g��
$cf{gethostbyaddr} = 0;

# �A�N�Z�X�����i��������Δ��p�X�y�[�X�ŋ�؂�A�A�X�^���X�N�j
# �� ���ۃz�X�g������IP�A�h���X�̋L�q��
#   �i�O����v�͐擪�� ^ ������j�y��z^210.12.345.*
#   �i�����v�͖����� $ ������j�y��z*.anonymizer.com$
$cf{denyhost} = '';

# �֎~���[�h
# �� ���e���֎~���郏�[�h���R���}�ŋ�؂�
$cf{no_wd} = '�A�_���g,�o�';

#===========================================================
#  ���ݒ芮��
#===========================================================

# for content-type charset
$cf{charset} = $cf{kcode} eq 'utf8' ? 'utf-8' : 'shift_jis';

# �����R�[�h�ϊ����W���[��
if ($] < 5.006) {
	require './lib/jacode.pl';
	$cf{conv_pm} = 'j';
} else {
	require Unicode::Japanese;
	$cf{conv_pm} = 'u';
}

# �ݒ�l��Ԃ�
sub set_init {
	return %cf;
}


1;

