// Ҫ��������ݶ���FormContent
var FormContent = document.getElementById("content");
// ��ʾ������Ϣ�Ķ���
var AutoSaveMsg = document.getElementById("AutoSaveMsg");
// �Զ�����ʱ����
var AutoSaveTime = 60000;
// ��ʱ������
var AutoSaveTimer;
// ��������һ���Զ�����״̬
SetAutoSave();
// �Զ����溯��
function AutoSave(){
// �������Ϊ�գ��򲻽��д���ֱ�ӷ���
if(!FormContent.value) return;
// ����AJAXRequest����
var ajaxobj=new AJAXRequest;
ajaxobj.url="inc/autosave.asp";
ajaxobj.content="postcontent="+escape(FormContent.value);
ajaxobj.callback=function(xmlObj) 
{
// ��ʾ������Ϣ
AutoSaveMsg.innerHTML=xmlObj.responseText;
}
ajaxobj.send();
}


// �����Զ�����״̬����
function SetAutoSave() 
{
AutoSaveTimer=setInterval("AutoSave()",AutoSaveTime);
}

// �ָ���󱣴�Ĳݸ�
function AutoSaveRestore()
{
// ����AJAXRequest����
var ajaxobj=new AJAXRequest;
AutoSaveMsg.innerHTML="���ڻָ������Ժ򡭡�"
ajaxobj.url="inc/autosave.asp";
ajaxobj.content="action=restore";
ajaxobj.callback=function(xmlObj)
{
AutoSaveMsg.innerHTML="�ָ���󱣴�ɹ�";
// �������Ϊ���򲻸�дtextarea������
if(xmlObj.responseText!="")
{
// �ָ��ݸ�
FormContent.value=xmlObj.responseText;
}
}
ajaxobj.send()
}