#include <stdio.h>

void Fibo(int turn);

int main(void)
{
	int turn;

	printf("출력할 피보나치(Fibonacci)수열의 갯 수를 입력하시오 : ");
	scanf("%d", &turn);
	Fibo(turn);
	return 0;
}

void Fibo(int turn)	// 피보나치 수열 배열함수
{
	int round = 1;
	int result1 = 1;
	int result2 = 0;

	printf("start! \n");
	printf("%d ", result2);

	while (round < turn)
	{
		if (round % 2 == 1)	// 홀수 번째 피보나치 수열 계산
		{
			result1 += result2;
			printf("%d ", result1);
		}
		else  // 짝수 번째 피보나치 수열 계산
		{
			result2 += result1;
			printf("%d ", result2);
		}
		round++;
	}
	printf("\nEnd \n");
}