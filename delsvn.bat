@echo on 
color 2f 
mode con: cols=80 lines=25 
@REM 
@echo ��������SVN�ļ������Ժ�...... 
@rem ѭ��ɾ����ǰĿ¼����Ŀ¼�����е�SVN�ļ� 
@rem for /r . %%a in (.) do @if exist "%%a\.svn" @echo "%%a\.svn" 
@for /r . %%a in (.) do @if exist "%%a\.svn" rd /s /q "%%a\.svn" 
@echo ������ϣ����� 
@pause 