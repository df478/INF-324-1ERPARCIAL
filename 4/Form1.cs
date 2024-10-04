using System;
using System.Data.SqlClient;
using System.Windows.Forms;
namespace _1ERPARCIAL
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            string nombre = textBox1.Text;
            string contrase�a = textBox2.Text;

            string connectionString = "server=(local);database=bdeleazar;Integrated Security=True;"; // Cambia esto por tu cadena de conexi�n
            using (SqlConnection conn = new SqlConnection(connectionString))
            {
                conn.Open();

                string sql = "SELECT * FROM Usuarios WHERE nombre = @nombre";
                using (SqlCommand cmd = new SqlCommand(sql, conn))
                {
                    cmd.Parameters.AddWithValue("@nombre", nombre);
                    SqlDataReader reader = cmd.ExecuteReader();

                    if (reader.Read())
                    {
                        // Verificar la contrase�a (deber�as usar hash y verificaci�n en producci�n)
                        if (reader["contrase�a"].ToString() == contrase�a)
                        {
                            MessageBox.Show("Inicio de sesi�n exitoso.");
                            // Aqu� podr�as guardar informaci�n en la sesi�n, si fuera necesario
                            // Redirect to main page or next form
                            if (reader["rol"].ToString() == "funcionario")
                            {
                                Form2 f = new Form2();
                                f.Show();
                                this.Hide();
                            }
                            else
                            {
                                Form3 f = new Form3();
                                f.Show();
                                this.Hide();
                            }
                            
                        }
                        else
                        {
                            MessageBox.Show("Contrase�a incorrecta.");
                        }
                    }
                    else
                    {
                        MessageBox.Show("Usuario no encontrado.");
                    }
                }
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {

        }
    }
}
