<?php
/**
* 	�����˺���Ϣ
*/

class WxPayConfig
{
	//=======��������Ϣ���á�=====================================
	//
	/**
	 * TODO: �޸���������Ϊ���Լ�������̻���Ϣ
	 * ΢�Ź��ں���Ϣ����
	 * 
	 * APPID����֧����APPID���������ã������ʼ��пɲ鿴��
	 * 
	 * MCHID���̻��ţ��������ã������ʼ��пɲ鿴��
	 * 
	 * KEY���̻�֧����Կ���ο������ʼ����ã��������ã���¼�̻�ƽ̨�������ã�
	 * ���õ�ַ��https://pay.weixin.qq.com/index.php/account/api_cert
	 * 
	 * APPSECRET�������ʺ�secert����JSAPI֧����ʱ����Ҫ���ã� ��¼����ƽ̨�����뿪�������Ŀ����ã���
	 * ��ȡ��ַ��https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
	 * @var string
	 */
	const APPID = 'wx31076e2b4a87f286';
	const MCHID = '1441648602';
	const KEY = 'asdfghjklQWER1234TYUIOPzxcvbxkas';
	const APPSECRET = '886da27300a7b084c23cd8b745d60617';
	
	//=======��֤��·�����á�=====================================
	/**
	 * TODO�������̻�֤��·��
	 * ֤��·��,ע��Ӧ����д����·�������˿��������ʱ��Ҫ���ɵ�¼�̻�ƽ̨���أ�
	 * API֤�����ص�ַ��https://pay.weixin.qq.com/index.php/account/api_cert������֮ǰ��Ҫ��װ�̻�����֤�飩
	 * @var path
	 */
	const SSLCERT_PATH = '../cert/apiclient_cert.pem';
	const SSLKEY_PATH = '../cert/apiclient_key.pem';
	
	//=======��curl�������á�===================================
	/**
	 * TODO���������ô��������ֻ����Ҫ�����ʱ������ã�����Ҫ����������Ϊ0.0.0.0��0
	 * ������ͨ��curlʹ��HTTP POST�������˴����޸Ĵ����������
	 * Ĭ��CURL_PROXY_HOST=0.0.0.0��CURL_PROXY_PORT=0����ʱ����������������Ҫ�����ã�
	 * @var unknown_type
	 */
	const CURL_PROXY_HOST = "0.0.0.0";//"10.152.18.220";
	const CURL_PROXY_PORT = 0;//8080;
	
	//=======���ϱ���Ϣ���á�===================================
	/**
	 * TODO���ӿڵ����ϱ��ȼ���Ĭ�Ͻ������ϱ���ע�⣺�ϱ���ʱ��Ϊ��1s�����ϱ����۳ɰܡ������׳��쳣����
	 * ����Ӱ��ӿڵ������̣��������ϱ�֮�󣬷���΢�ż��������õ���������������
	 * ���������ϱ���
	 * �ϱ��ȼ���0.�ر��ϱ�; 1.����������ϱ�; 2.ȫ���ϱ�
	 * @var int
	 */
	const REPORT_LEVENL = 2;

	//=======��������Ϣ���á�===================================
	/**
	 * DOMAIN_NAME��PC����������ʽ��http://www.woniuw.com/��Ҫ����http://��ĩβ��/��
	 * M_DOMAIN_NAME���ֻ�����������ʽ��http://www.woniuw.com/��Ҫ����http://��ĩβ��/��
	 * NOTIFY_URL���ص���ַ����רҵ��ʿ�����޸�
	 * SITENAME����վ����
	 * SUCCESS��֧���ɹ�����ת��ַ
	 * M_SUCCESS���ֻ���֧���ɹ���ת��ַ
	 * ����Ӱ��ӿڵ������̣��������ϱ�֮�󣬷���΢�ż��������õ���������������
	 */
	const DOMAIN_NAME = 'http://xs.tb800.top/';
	const M_DOMAIN_NAME = 'http://m.xs.tb800.top/';
	const NOTIFY_URL = 'http://xs.tb800.top/modules/pay/weixin/notify.php';
	const SITENAME = 'JuFengWang';
	const SUCCESS = 'http://xs.tb800.top/modules/pay/paylog.php';
	const M_SUCCESS = 'http://xs.tb800.top/login.php';
}
