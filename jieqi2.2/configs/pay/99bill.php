<?php
//��Ǯ����֧����ز���

$jieqiPayset['99bill']['payid'] = '10012408238';  //�̻����

$jieqiPayset['99bill']['paykey'] = '54928G080r86S64B77a5Z45DA4U6IT61hd2189x040o758QA8L0rypj96K09';  //��Կֵ

$jieqiPayset['99bill']['payurl'] = 'https://www.99bill.com/gateway/recvMerchantInfoAction.htm';  //�ύ��֧����վ����ַ

$jieqiPayset['99bill']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/99billreturn.php';  //��վ���շ��ص���ַ

$jieqiPayset['99bill']['payrate'] = 100; //Ĭ��1ԪǮ�һ�����ҵ�ֵ
$jieqiPayset['99bill']['paycustom'] = 0; //�Ƿ������Զ��幺���0-������1-����
$jieqiPayset['99bill']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //����ѡ��� �����=>��� ѡ��� '1000'=>'10' ��ָ���� 1000�������Ҫ10Ԫ

$jieqiPayset['99bill']['moneytype'] = '0';  //�ֽ����ͣ�0-����� 1-��Ԫ
$jieqiPayset['99bill']['paysilver'] = '0';  //���������:0-��� 1-����(Ŀǰ�����ҹ��ܣ���Ĭ�����ó�0)

//����˽�в���
$jieqiPayset['99bill']['inputCharset'] = '2'; //�ַ���,��Ϊ�ա�1����UTF-8; 2����GBK; 3����gb2312 Ĭ��ֵΪ1

$jieqiPayset['99bill']['version'] = 'v2.0';  //������汾�Ź̶�Ϊv2.0

$jieqiPayset['99bill']['language'] = '1';  //1�������ģ�2����Ӣ�� Ĭ��ֵΪ1

$jieqiPayset['99bill']['signType'] = '1'; //1����MD5ǩ�� ��ǰ�汾�̶�Ϊ1

///ֻ��ѡ��00��10��11��12��13��14
///00�����֧��������֧��ҳ����ʾ��Ǯ֧�ֵĸ���֧����ʽ���Ƽ�ʹ�ã�10�����п�֧��������֧��ҳ��ֻ��ʾ���п�֧����.11���绰����֧��������֧��ҳ��ֻ��ʾ�绰֧����.12����Ǯ�˻�֧��������֧��ҳ��ֻ��ʾ��Ǯ�˻�֧����.13������֧��������֧��ҳ��ֻ��ʾ����֧����ʽ��.14��B2B֧��������֧��ҳ��ֻ��ʾB2B֧��������Ҫ���Ǯ���뿪ͨ����ʹ�ã�
$jieqiPayset['99bill']['payType'] = '00';

$jieqiPayset['99bill']['fullAmountFlag'] = '0';  //0�������С�ڶ������ʱ����֧�����Ϊʧ�ܣ�1�������С�ڶ�������Ƿ���֧�����Ϊ�ɹ���ͬʱ��������ʵ��֧����Ϊ�����п������.����̻����������п���ֱ��ʱ���������̶�ֵΪ1

$jieqiPayset['99bill']['ext1'] = '';  //��չ�ֶ�1

$jieqiPayset['99bill']['ext2'] = '';  //��չ�ֶ�2

$jieqiPayset['99bill']['addvars'] = array();  //���Ӳ���
?>