<?php
//�ױ��㿨֧����ز���

$jieqiPayset['yeecard']['payid'] = '123456';  //�������ID��������ʵ�������ֵ��

$jieqiPayset['yeecard']['paykey'] = '000000';  //ͨѶ��Կֵ��������ʵ�������ֵ��

$jieqiPayset['yeecard']['payurl'] = 'https://www.yeepay.com/app-merchant-proxy/command.action';  //�ύ���Է�����ַ

$jieqiPayset['yeecard']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/yeecardreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

if(in_array($_REQUEST['cardtype'], array('SZX', 'UNICOM', 'TELECOM'))){
	$jieqiPayset['yeecard']['payrate'] = 85; //Ĭ��1ԪǮ�һ�����ҵ�ֵ
}else{
	$jieqiPayset['yeecard']['payrate'] = 75; //Ĭ��1ԪǮ�һ�����ҵ�ֵ
}
$jieqiPayset['yeecard']['paycustom'] = 1; //�Ƿ������Զ��幺���0-������1-����
$jieqiPayset['yeecard']['paylimit'] = array(); //����ѡ��� �����=>��� ѡ��� '1000'=>'10' ��ָ���� 1000�������Ҫ10Ԫ

$jieqiPayset['yeecard']['moneytype'] = '0';  //�ֽ����ͣ�0-����� 1-��Ԫ
$jieqiPayset['yeecard']['paysilver'] = '0';  //���������:0-��� 1-����(Ŀǰ�����ҹ��ܣ���Ĭ�����ó�0)

//����˽�в���
$jieqiPayset['yeecard']['messageType'] = 'ChargeCardDirect';  //ҵ������

$jieqiPayset['yeecard']['verifyAmt'] = 'true';  //�Ƿ���鶩����� ֵ��trueУ����;  false��У���

$jieqiPayset['yeecard']['productId'] = JIEQI_EGOLD_NAME;  //��Ʒ��

$jieqiPayset['yeecard']['productDesc'] = JIEQI_EGOLD_NAME;  //��Ʒ����

$jieqiPayset['yeecard']['productCat'] = '';  //��Ʒ����

$jieqiPayset['yeecard']['sMctProperties'] = '';  //���Ӳ���

$jieqiPayset['yeecard']['frpId'] = '';  //֧����������

$jieqiPayset['yeecard']['needResponse'] = '1';  //�Ƿ���ҪӦ����ƣ�Ĭ�ϻ�"0"Ϊ����Ҫ,"1"Ϊ��Ҫ

$jieqiPayset['yeecard']['pz_userId'] = '';  //�û����̻�����ΨһID

$jieqiPayset['yeecard']['pz1_userRegTime'] = '';  //�û�ע��ʱ��

$jieqiPayset['yeecard']['addvars'] = array();  //���Ӳ���

?>