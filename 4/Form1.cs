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
            string contraseña = textBox2.Text;

            string connectionString = "server=(local);database=bdeleazar;Integrated Security=True;"; // Cambia esto por tu cadena de conexión
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
                        // Verificar la contraseña (deberías usar hash y verificación en producción)
                        if (reader["contraseña"].ToString() == contraseña)
                        {
                            MessageBox.Show("Inicio de sesión exitoso.");
                            // Aquí podrías guardar información en la sesión, si fuera necesario
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
                            MessageBox.Show("Contraseña incorrecta.");
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
