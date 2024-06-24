/**
 * Program: Main.c
 * Author:  - Muhamad Yasir Noval/2350081004
 *          - Muhamad Yusron Noval/235081003
 *          - Muhammad Abhinaya Rakan Albarra/2350081011
 * Date: 3 Desember 2023
 * Description: Diketahui sekumpulan data berupa nilai ujian berupa
 * UTS, tugas dan UAS, dengan rentang 10-100, setiap data nilai di-
 * berikan kelas datanya, yaitu Baik = A, Cukup = B, atau Buruk = C.
 *
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>

#define baris 10
#define kolom 5

typedef struct {
    int nilai[baris + 1][kolom + 1];
    int neffBaris;
    int neffKolom;
} TabNilaiLama;

typedef struct {
    int nilai[baris + 1][kolom + 1];
    int neffBaris;
    int neffKolom;
} TabNilaiBaru;

// prototype
void createTab(TabNilaiLama *TLama, TabNilaiBaru *TBaru);

void cetakTab(TabNilaiLama T);

void cetakTabBaru(TabNilaiBaru T);

void AddNilai(TabNilaiBaru *TBaru, int uts, int tugas, int uas);

void createData(TabNilaiLama *TLama);

void CekJarak(TabNilaiLama *TLama, TabNilaiBaru *TBaru, int K);

void UrutDataAscending(TabNilaiLama *TLama);

void CekLabel(TabNilaiLama T, int K);

int main() {
    // kamus lokal
    int uts, tugas, uas, K, N;
    TabNilaiLama tabNilaiLama;
    TabNilaiBaru tabNilaiBaru;


    // algoritma
    createTab(&tabNilaiLama, &tabNilaiBaru);
    createData(&tabNilaiLama);

    printf("\n\tPROGRAM PREDIKSI KELAS DATA\n");

    printf("Tabel Data Nilai\n");
    cetakTab(tabNilaiLama);

    N = 1;
    while (N != 0) {
        printf("\nMasukan Nilai UTS: ");
        scanf("%d", &uts);

        printf("Masukan Nilai Tugas: ");
        scanf("%d", &tugas);

        printf("Masukan Nilai UAS: ");
        scanf("%d", &uas);

        AddNilai(&tabNilaiBaru, uts, tugas, uas);

        printf("\napakah anda ingin menambah nilai lagi? [1/0]: ");
        scanf("%d", &N);
    }

    printf("\nTabel Data Nilai Baru\n");
    cetakTabBaru(tabNilaiBaru);

    printf("\n\nMasukan K: ");
    scanf("%d", &K);

    printf("\n\nTabel Data Nilai\n");
    CekJarak(&tabNilaiLama, &tabNilaiBaru, K);

    return 0;
}

// body of prototype
void createTab(TabNilaiLama *TLama, TabNilaiBaru *TBaru) {
    // kamus lokal

    // algoritma
    (*TLama).neffBaris = 0;
    (*TLama).neffKolom = 0;

    (*TBaru).neffBaris = 0;
    (*TBaru).neffKolom = 0;
}

void AddNilai(TabNilaiBaru *TBaru, int uts, int tugas, int uas) {
    // kamus lokal
    int i;

    // algoritma
    (*TBaru).neffKolom = kolom;

    if ((*TBaru).neffBaris < baris) {
        (*TBaru).neffBaris++;
        for (i = 0; i <= kolom; i++) {
            if ((*TBaru).neffKolom <= kolom) {
                if (i == 0) {
                    (*TBaru).nilai[(*TBaru).neffBaris][i] = (*TBaru).neffBaris;
                } else if (i == 1) {
                    (*TBaru).nilai[(*TBaru).neffBaris][i] = uts;
                } else if (i == 2) {
                    (*TBaru).nilai[(*TBaru).neffBaris][i] = tugas;
                } else if (i == 3) {
                    (*TBaru).nilai[(*TBaru).neffBaris][i] = uas;
                }
            }
        }
    }
}

void createData(TabNilaiLama *TLama) {
    // kamus lokal
    int i, j;

    // algoritma
    srand(time(NULL));

    for (i = 0; i < baris; i++) {
        if ((*TLama).neffBaris < baris) {
            (*TLama).neffBaris++;
        }
        for (j = 0; j < kolom; j++) {
            if ((*TLama).neffKolom < kolom) {
                (*TLama).neffKolom++;
            }

            if (j == 0) {
                (*TLama).nilai[i][j] = i + 1;
            } else if (j == 2) {
                (*TLama).nilai[i][j] = rand() % (90 - 70 + 1) + 70;
            } else if (j == 4) {
                (*TLama).nilai[i][j] = 0;
            } else {
                (*TLama).nilai[i][j] = 10 + rand() % (95 - 10 + 1);
            }
        }
    }
}

void cetakTab(TabNilaiLama T) {
    // kamus lokal
    int i, j, sum;

    // algoritma
    printf("No\t| UTS\t| Tugas\t| UAS\t| K\t| Kelas Data\t|\n");
    for (i = 0; i < T.neffBaris; i++) {
        for (j = 0; j < T.neffKolom; j++) {
            printf(" %d\t|", T.nilai[i][j]);
        }
        sum = (T.nilai[i][1] + T.nilai[i][2] + T.nilai[i][3]) / 3;
        if (sum > 70) {
            printf(" Baik\t\t|");
        } else if (sum > 60) {
            printf(" Cukup\t\t|");
        } else {
            printf(" Buruk\t\t|");
        }

        printf("\n");
    }
}

void cetakTabBaru(TabNilaiBaru T) {
    // kamus lokal
    int i, j;


    // algoritma
    printf("No\t| UTS\t| Tugas\t| UAS\t|\n");
    for (i = 1; i <= T.neffBaris; i++) {
        for (j = 0; j < T.neffKolom - 1; j++) {
            printf(" %d\t|", T.nilai[i][j]);
        }

        printf("\n");
    }
}

void CekJarak(TabNilaiLama *TLama, TabNilaiBaru *TBaru, int K) {
    // kamus lokal
    int jarak, i, j;

    // algoritma
    for (j = 1; j <= (*TBaru).neffBaris; j++) {
        for (i = 0; i < (*TLama).neffBaris; i++) {
            jarak = ((*TBaru).nilai[j][1] - (*TLama).nilai[i][1]) + ((*TBaru).nilai[j][2] - (*TLama).nilai[i][2]) +
                    ((*TBaru).nilai[j][3] - (*TLama).nilai[i][3]);
            (*TLama).nilai[i][4] = jarak;
        }

        UrutDataAscending(TLama);
        printf("\n");
        cetakTab(*TLama);
        printf("\n");

        printf("Mahasiswa ke-%d mendapatkan nilai: ", j);
        CekLabel(*TLama, K);
        printf("\n");

    }
}

void UrutDataAscending(TabNilaiLama *TLama) {
    // Kamus lokal
    int i, j, tmp, N;

    // Algoritma
    N = (*TLama).neffBaris;

    for (i = N; i > 1; i--) {
        for (j = 1; j < i; j++) {
            // Compare the classes (baik, cukup, buruk) instead of distances
            int classA = (*TLama).nilai[j - 1][4];
            int classB = (*TLama).nilai[j][4];

            if (classA > classB) {
                // Swap the entire rows
                for (int k = 0; k < kolom + 1; k++) {
                    tmp = (*TLama).nilai[j - 1][k];
                    (*TLama).nilai[j - 1][k] = (*TLama).nilai[j][k];
                    (*TLama).nilai[j][k] = tmp;
                }
            }
        }
    }
}

void CekLabel(TabNilaiLama T, int K) {
    // kamus lokal
    int i, rataRata;
    int baik, cukup, buruk;

    // algoritma
    baik = 0;
    cukup = 0;
    buruk = 0;

    for (i = 1; i <= K; i++) {
        rataRata = (T.nilai[i][1] + T.nilai[i][2] + T.nilai[i][3]) / 3;
        if (rataRata > 70) {
            baik = baik + 1;
        } else if (rataRata > 60) {
            cukup = cukup + 1;
        } else {
            buruk = buruk + 1;
        }
    }

    if (baik > cukup && baik > buruk) {
        printf("Baik");
    } else if (cukup > baik && cukup > buruk) {
        printf("Cukup");
    } else if (buruk > baik && buruk > cukup) {
        printf("Buruk");
    } else {
        printf("Data tidak valid");
    }
}