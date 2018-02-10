#include <stdio.h>

void Fibo(int turn);

int main(void)
{
	int turn;

	printf("����� �Ǻ���ġ(Fibonacci)������ �� ���� �Է��Ͻÿ� : ");
	scanf("%d", &turn);
	Fibo(turn);
	return 0;
}

void Fibo(int turn)	// �Ǻ���ġ ���� �迭�Լ�
{
	int round = 1;
	int result1 = 1;
	int result2 = 0;

	printf("start! \n");
	printf("%d ", result2);

	while (round < turn)
	{
		if (round % 2 == 1)	// Ȧ�� ��° �Ǻ���ġ ���� ���
		{
			result1 += result2;
			printf("%d ", result1);
		}
		else  // ¦�� ��° �Ǻ���ġ ���� ���
		{
			result2 += result1;
			printf("%d ", result2);
		}
		round++;
	}
	printf("\nEnd \n");
}