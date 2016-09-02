#!/bin/bash


sed -i 's/ 1 1 4 / 3 1 4 /' data.insSphereInterim

# fixes the 'template-ID' of the molecule 'Solid.molecule' to make the date.XX readable in the next part of the 'in.relaxFluid'
