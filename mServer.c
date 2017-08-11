#include<stdio.h>
#include<stdlib.h>
#include<sys/socket.h>
#include<sys/types.h>
//#include<net inet/in.h>
#include<error.h>
//#include<strings.h>
#include<string.h>
#include<unistd.h> // write
#include<arpa/inet.h>
#include<pthread.h> //for threading , link with lpthread
#include<assert.h>
#include <mysql.h>
#include <my_global.h>

#define ERROR -1
#define MAX_CLIENTS 2
#define MAX_DATA 1024
char client_message[2000]; 
char username[200];
int memberid[20];
char login[20];

 void *connection_handler(void *);
 int handle_client_message();
 void writeToFile();
 char** str_split(char* a_str, const char a_delim);
 void database();
 //void confirmAmount();
 
int main(int argc, char **argv)
  {
        struct sockaddr_in server;
        struct sockaddr_in client;
        int sock , *new_sock;
        int new;
        int sockaddr_len = sizeof(struct sockaddr_in);
        int data_len;
        char data[MAX_DATA];

	
     if((sock = socket(AF_INET, SOCK_STREAM,0))== ERROR)
           {
             perror("server socket");
             exit(-1);
            }
			puts("Socket Created");
	
         server.sin_family = AF_INET;
         server.sin_port = htons(1199);
         server.sin_addr.s_addr = INADDR_ANY;
         //bzero(&server.sin_zero,8);

	
      if((bind(sock,(struct sockaddr *) &server, sockaddr_len))== ERROR)
      {
        perror("bind");
        exit(-1);
      }

		puts("binding done");
      if((listen(sock, MAX_CLIENTS))==ERROR)
      {
        perror("listen");
        exit(-1);
       }

	puts("Listening..");

   
   /*while(1){

   	if((new = accept(sock, (struct sockaddr*)&client, &sockaddr_len))==ERROR)
   	{
     perror("accept");
     exit(-1);
    }
	
	puts("Accepted");

  	printf("New client connect from portno %d and IP %s\n ", ntohs(client.sin_port), inet_ntoa(client.sin_addr));
    data_len = 1;

    while(data_len) {
        data_len = recv(new,data,MAX_DATA,0);
		puts("Received");
       if(data_len)
       {
         send(new,data,data_len,0);
         data[data_len]= '\0';
         printf("sent mesg: %s",data);
       }
     }
     
    printf("client disconnected\n");
	}*/
	// added by muwonge
	while( (new = accept(sock, (struct sockaddr *)&client, (socklen_t*)&sockaddr_len)) )
    {
        puts("Connection accepted");
         
        pthread_t sniffer_thread;
        new_sock = malloc(1);
        *new_sock = new;
         
        if( pthread_create( &sniffer_thread , NULL ,  connection_handler , (void*) new_sock) < 0)
        {
            perror("could not create thread");
            return 1;
        }
         
        //Now join the thread , so that we dont terminate before the thread
        //pthread_join( sniffer_thread , NULL);
        puts("Handler assigned");
    }
     
    if (new < 0)
    {
        perror("accept failed");
        return 1;
    }
}

void *connection_handler(void *sock)
{
    //Get the socket descriptor
    int sockets = *(int*)sock;
    int size;
    //variables for connectivity to the mysql database
    static char *host = "localhost";
	static char *user = "root";
	static char *password = "";
	static char *dbname = "FSACCO";
	static char *unix_socket = "/opt/lampp/var/mysql/mysql.sock";
	MYSQL *con;
	MYSQL_RES *result;
	MYSQL_ROW row;
	int num_fields;
	char true_memberid[200];

     
     	//MYSQL *conn;

	con = mysql_init(NULL);
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
	
/*	if( ( (size = recv(sockets , username , 200 , 0)) > 0 ) && ( (size = recv(sockets , memberid , 20 , 0)) > 0 ) )
	{
*/		
//{
			  //Send some messages to the client
     
    //Receive a message from client
  //memset(client_message,0, 2000);
    while( (size = recv(sockets , client_message , 2000 , 0)) > 0 )
    {
    client_message[size] = 0; // terminate string
        //Send the message back to client
    printf("Client message : [%s]\n", client_message);
    handle_client_message();
       write(sockets , client_message , strlen(client_message));
    }
     
    /*if(size == 0)
    {
        puts("Client disconnected");
    num_clients--;
        fflush(stdout);
    }
    else */
    if(size == -1)
    {
        perror("recv failed");
    }
         
    //Free the socket pointer
    free(sock);
     
   return 0;
//}

//		}
}

  
void writeToFile(){
  

  FILE *fileptr;

  fileptr = fopen("MembersFile.txt","a");

  if (fileptr == NULL)
  {
    puts("File not available");
  }

  

  fprintf(fileptr, "%s\n", client_message);
 

  fclose(fileptr);
}

int handle_client_message()
{
   char buff[256];
   int pat;
   char message[25];
   char message2[25];
   int i = 0;

   MYSQL *con;
   MYSQL_RES *result;
   MYSQL_ROW row;
   int num_fields;
   char true_memberid[200];

switch (client_message[0])
  {
    case 'b':
    // benefits check
    if (!strcmp(client_message,"benefits check")) {
      client_message[0] = 0;
      sprintf(client_message,"your request for checking your benefits has\nsuccessfully reached our mysql database \r\n\n\n");
      }
    else {
        sprintf(client_message,"\n\n\nUnknown Command\r\n\n\n");
      }

    break;
    
      case'c':
        //contribution
      while(i<=12)
      {
        message[i] = client_message[i];
        i++;
      }
      //puts(message);

      if (!strcmp(client_message,"contribution check")) {
      client_message[0] = 0;
      sprintf(client_message,"your request for contribution check has\nsuccessfully reached our mysql database \r\n\n\n");
      //writeToFile();
      }

      else if (!strcmp(message,"contribution ")) {
      writeToFile();
      client_message[0] = 0;
      sprintf(client_message,"your details has been successfully written to the file\r\n\n\n");
      }

      else {
        sprintf(client_message,"Unknown Command\r\n\n\n");
      }

      break;

      case 'h':
      // help
    if (!strcmp(client_message,"help")) {
    client_message[0] = 0;
      sprintf(buff,"\n\n\ncontribution amount date person_name receipt_number   -- To submit a contribution\r\n");
      strcat(client_message,buff);
      sprintf(buff,"contribution check --- to see how much has been contributed\r\n");
      strcat(client_message,buff);
      sprintf(buff,"benefits check ---- To see how much has been received in benefits only\r\n");
      strcat(client_message,buff);
      sprintf(buff,"loan request amount --- request for loan\r\n");
      strcat(client_message,buff);
      sprintf(buff,"loan status  --- check loan status (Approved, denied or pending)\r\n");
      strcat(client_message,buff);
      sprintf(buff,"load repayment_details – check the loan repayment details ie which amounts and how much per month\r\n");
      strcat(client_message,buff);
      sprintf(buff,"idea name capital “simple description”\r\n\n\n\n");
      strcat(client_message,buff);
    }
    else {
        sprintf(client_message,"\n\n\nUnknown Command\r\n\n\n");
      }


      //sprintf(buff,"Connected Clients: %d\r\n", num_clients);
      //strcat(client_message,buff);
      break;

      case'i':
        //contribution
      while(i<=4)
      {
        message[i] = client_message[i];
        i++;
      }
      puts(message);
      if (!strcmp(message,"idea ")) {
      writeToFile();
      client_message[0] = 0;
      sprintf(client_message,"your details about the idea has been\nsuccessfully written to the file\r\n\n\n");
      }

      else {
        sprintf(client_message,"Unknown Command\r\n\n\n");
      }

      break;

      case'l':
        //contribution
      while(i<=12)
      {
        message[i] = client_message[i];
        i++;
      }
      i=0;
      while(i<=5)
      {
        message2[i] = client_message[i];
        i++;
      }
      //puts(message);

      if (!strcmp(client_message,"loan status")) {
      client_message[0] = 0;
      sprintf(client_message,"your request for seeing your loan status has\nsuccessfully reached our mysql database \r\n\n\n");
      }

      else if (!strcmp(client_message,"load repayment_details")) {
      client_message[0] = 0;
      sprintf(client_message,"your request for seeing your repayment details has\nsuccessfully reached our mysql database \r\n\n\n");
      }
      
      else if (!strcmp(client_message,"logout")) {
     	client_message[0] = 0;
        sprintf(client_message,"You have succesfully logged out \r\n\n\n");
        return EXIT_SUCCESS;
    	}

      else if (!strcmp(message,"loan request ")) {
      writeToFile();
      client_message[0] = 0;
      sprintf(client_message,"your details has been successfully written to the file\r\n\n\n");
      }
      else if(!strcmp(message2,"login ")) 
		{
        	sscanf(client_message,"%s%s",login,username);
          puts(login);
          puts(username);
        	//client_message[0] = 0;

        	
          snprintf(true_memberid,sizeof true_memberid,"SELECT memberid FROM member WHERE username=('%s');",username);
		
			if(!(mysql_query(con,true_memberid)))
			 {
			 	fprintf(stderr, "\nError : %s\n",mysql_error(con)) ;
        
			 }
			 puts("its here !!!");
			 result = mysql_store_result(con);
			 

	while((row = mysql_fetch_row(result)))
	{
		//for (int i = 0; i < num_fields; ++i)
		//{
			/* code */
			sprintf(true_memberid,"%s\n", row[0]);
			strcat(client_message,buff);
		}

    puts(true_memberid);
		strcat(client_message,buff);
	}
	
/*		if(true_memberid == "")
		{
			//client_message[0] = 0;
			sprintf(client_message,"Not a member !!!\r\n\n\n");
		}
			*/
    

      else {
        sprintf(client_message,"Unknown Command\r\n\n\n");
      }

      break;
      
      default:
      //client_message[0] = 0;
      sprintf(client_message,"Unknown Command\r\n\n\n");
      break;
  }

  return 0;
}
