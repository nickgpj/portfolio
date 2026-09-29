using EindopdrachtDD1.Model;
using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace EindopdrachtDD1.Databases
{
    class AppDbContext : DbContext
    { 
        public DbSet<Character> Characters { get; set; }

        public DbSet<Game> Games { get; set; }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            base.OnConfiguring(optionsBuilder);
            string? constr = ConfigurationManager.ConnectionStrings["MyConnStr"].ConnectionString;
            if (constr == null)
            {
                throw new Exception("Connection string MyConnStr niet gevonden");
            }
            optionsBuilder.UseMySQL(constr);
        }
    }
}
