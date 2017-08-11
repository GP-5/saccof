#include <stdio.h>
#include <stdlib.h>
#include <mysql.h>
#include <my_global.h>

static char *host = "localhost";
static char *user = "root";
static char *password = "";
static char *dbname = "emma";
static char *unix_socket = "/opt/lampp/var/mysql/mysql.sock";

/*void finish_with_error(MYSQL *con)
{
	fprintf(stderr, "%s\n", mysql_error(con));
	mysql_close(con);
	exit(1);
}*/

int main(){

	//MYSQL *conn;

	MYSQL *con = mysql_init(NULL);
	if (con ==NULL)
	{
		fprintf(stderr, "mysql_init() failed\n");
		exit(1);
	}
	if (!(mysql_real_connect(con,host,user,password,dbname,3306,unix_socket,0)))
	{
		/* code */
		fprintf(stderr, "\nError : %s[%d]\n",mysql_error(con),mysql_errno(con) );
		exit(1);
	}

	printf("connection successful !!! \n\n");

	if (mysql_query(con, "SELECT * FROM benefits"))
	{
		fprintf(stderr, "\nError : %s[%d]\n",mysql_error(con),mysql_errno(con) );
		exit(1);
	}

	MYSQL_RES *result = mysql_store_result(con);
	if (result == NULL)
	{
		/* code */
		fprintf(stderr, "\nError : %s[%d]\n",mysql_error(con),mysql_errno(con) );
		exit(1);
	}

	int num_fields = mysql_num_fields(result);

	MYSQL_ROW row;
	while((row = mysql_fetch_row(result)))
	{
		for (int i = 0; i < num_fields; ++i)
		{
			/* code */
			printf("%s\t", row[i] ? row[i] : "NULL");
		}

		printf("\n");
	}

	mysql_free_result(result);
	mysql_close(con);
	//return EXIT SUCCESS;
}